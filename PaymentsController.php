<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Http\Requests\Guest\StorePaymentsRequest;
use App\Payment;
use App\Payments_tickets;
use App\Ticket;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Stripe\Charge;
use Stripe\Error\Card;
use Stripe\Stripe;
use Illuminate\Support\Facades\Auth;
use Srmklive\PayPal\Services\ExpressCheckout;
use Event;
use PayPal\Api\Order;

// use Illuminate\Support\Facades\URL;

// use PayPal\Api\Amount;
// use PayPal\Api\Details;
// use PayPal\Api\Item;
// use PayPal\Api\ItemList;
// use PayPal\Api\Payer;
// // use PayPal\Api\Payment;
// use PayPal\Api\RedirectUrls;
// use PayPal\Api\Transaction;


// use PayPal\Api\ChargeModel;
// use PayPal\Api\Currency;
// use PayPal\Api\MerchantPreferences;
// use PayPal\Api\PaymentDefinition;
// use PayPal\Api\Plan;
// use PayPal\Api\Patch;
// use PayPal\Api\PatchRequest;
// use PayPal\Common\PayPalModel;
// use PayPal\Rest\ApiContext;
// use PayPal\Auth\OAuthTokenCredential;


class PaymentsController extends Controller
{
    public function store(StorePaymentsRequest $request)
    {
		$token = $request->input('stripeToken');
		$requestTotal = round(floatval($request->input('total')), 2);
		$requestTickets = json_decode($request->input('tickets'));
		$email = $request->input('email');

        $ids = array();
		foreach ($requestTickets->tickets as $entry ) {
            $ids[] = $entry->id;
            dd($ids);
        }

        $now = Carbon::now()->toDateString();
		// prevent obtaining tickets via crafted request
        $match = [
            ['available_from', '<=', $now],
            ['available_to', '>=', $now]
        ];
        $tickets = Ticket::where($match)->findMany($ids);

        // can we satisfy order at all?
        $total = $this->validateTotal($tickets, $requestTickets, $requestTotal);
        if($total) {
            return $this->createStripeCharge($token, $total, $requestTickets, $email);
        }

        return redirect()->back()->with('error', 'Please review your order and try again.');
    }

    public function makeTransaction($requestTickets, $total, $email)
    {
        try {
            DB::transaction(function() use ($requestTickets, $total, $email) {
                $newPayment = Payment::create([
                    'email' => $email,
                    'merchant' => 'Stripe',
                    'amount' => $total
                ]);
                foreach ($requestTickets->tickets as $entry ) {
                    $newPaymentsTickets = Payments_tickets::create([
                        'payment_id' => $newPayment->id,
                        'ticket_id' => $entry->id,
                        'tickets_amount' => $entry->amount
                    ]);
                    $ticket = Ticket::findOrFail($entry->id);
                    $ticket->update([
                        'amount' => $ticket->amount - $entry->amount
                    ]);
                }
            });
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Your order did not complete. Please try again.');
        }

        return redirect()->back()->with('message', 'Payment completed successfully.');
    }

    // calculate tickets' price
    // this is necessary due to price changes during payment
    // and make sure we have available tickets
    public function validateTotal($tickets, $requestTickets, $requestTotal)
    {
        $total = 0;
        foreach ($tickets as $ticket) {
            foreach ($requestTickets->tickets as $entry ) {
                if ($ticket->id === $entry->id && $ticket->amount > 0 && $ticket->amount >= (int)$entry->amount && (int)$entry->amount > 0) {
                    $total += $ticket->price * $entry->amount;
                }
            }
        }
        $total = round($total, 2);

        // compare requested order price against calculated
        // this cannot pass if ticket price changes or some tickets are not available anymore
        if ($total === $requestTotal) {
            return $total;
        }

        return False;
    }

    public function createStripeCharge($token, $total, $requestTickets, $email)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        try {
            $charge = Charge::create(array(
                "amount" => $total * 100,
                "currency" => "eur",
                "description" => "Ticket charge", // needs better description
                "source" => $token
            ));
        } catch (Card $e) {
            // get error message from $charge response
            return redirect()->back()->with('error', 'Your credit card has been declined.');
        }

        // call transaction post charge
        return $this->makeTransaction($requestTickets, $total, $email);
    }

    public function paySuccess(Request $request){
        $provider = new ExpressCheckout;      // To use express checkout.
        $token = $request->token;
        $payerId = $request->payerID;
        $response = $provider->getExpressCheckoutDetails($token);

        $invoiceId = $response["INVNUM"]??uniqid();

        $data = $this->cartData($request, $invoiceId);//Cart data

        $response = $provider->doExpressCheckoutPayment($data, $token, $payerId);

        // dd($response);
        // create the order
        // $payment = Payment::create($request->all());
        dd(auth()->users()->email);
        $payment = $request->input('email');
        $payment = $request->input('merchant');
        $payment = $request->input('amount');
        $payment->save();
     

        
        
        
        return "Payment Created";

    }

    public function payWithPaypal(Request $request){
        $provider = new ExpressCheckout;      // To use express checkout.
        $invoiceId = uniqid();
        $data = $this->cartData($request, $invoiceId);
        // $data['items'] = [
        //     [
        //         'name' => $request->input('event_title'),
        //         'price' => $request->input('amount_price'),
        //         'qty' => $request->input('qty')
        //     ],
        // ];

        $response = $provider->setExpressCheckout($data);

        // // Use the following line when creating recurring payment profiles (subscriptions)
        // $response = $provider->setExpressCheckout($data, true);

        // This will redirect user to PayPal
        return redirect($response['paypal_link']);
    }

    protected function cartData(Request $request, $invoiceId){

        $data = [];
        $data['items'] = [
            [
                'name' => $request->input('event_title'),
                'price' => $request->input('amount_price'),
                'qty' => $request->input('qty')
            ],
        ];

        $data['invoice_id'] = $invoiceId;
        $data['invoice_description'] = "Test";
        $data['return_url'] = route('payment.paypalSuccess');
        $data['cancel_url'] = url('/cart');

        $total = 0;
        foreach($data['items'] as $item) {
            $total += $item['price']*$item['qty'];
        }

        $data['total'] = $total;

        return $data;


    }
}


