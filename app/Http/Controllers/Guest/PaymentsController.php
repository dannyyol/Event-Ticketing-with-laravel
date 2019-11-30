<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Http\Requests\Guest\StorePaymentsRequest;
use App\Payment;
use App\Payments_tickets;
use App\Ticket;
use Carbon\Carbon;
// use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Stripe\Charge;
use Stripe\Error\Card;
use Stripe\Stripe;
use Illuminate\Support\Facades\Auth;
use Srmklive\PayPal\Services\ExpressCheckout;
use Event;
use PayPal\Api\Order;
use Illuminate\Support\Facades\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Gate;
use Session;
use Illuminate\Notifications\Notifiable;
use App\Notifications\TemplateEmail;


class PaymentsController extends Controller
{
    protected $provider;
    public function __construct() {
        $this->provider = new ExpressCheckout();
    }

    public function expressCheckout(Request $request,Payment $id) {
        // check if payment is recurring
        if (! Gate::allows('payment_access')) {
            return abort(401);
        }
        Cart::destroy();
        Cart::add("Paypal",$request::input('event_title'), $request::input('qty'), $request::input('amount_price'));
  
        $recurring = $request::input('recurring', false) ? true : false;
      
        // create new invoice
        $payment = new Payment();
        $payment->email = $request::input('email');
        $payment->merchant = 'Paypal';
        $payment->amount = $request::input('total');
        // dd($cart['total']);
        
        // dd(Cart::content());
        // dd(Cart::content());
        $payment->save();
        // get new invoice id
        $payment_id = $payment->id;
        
            
        // Get the cart data
        $cart = $this->getCart($recurring, $payment_id);
        
      
        // send a request to paypal 
        // paypal should respond with an array of data
        // the array should contain a link to paypal's payment system
        $response = $this->provider->setExpressCheckout($cart, $recurring);
      
        // if there is no link redirect back with error message
        if (!$response['paypal_link']) {
          return back()->with('danger', 'Something went wrong with PayPal');
          // For the actual error message dump out $response and see what's in there
        }
      
        // redirect to paypal
        // after payment is done paypal
        // will redirect us back to $this->expressCheckoutSuccess
        return redirect($response['paypal_link']);
        
      }

      public function getCart($recurring, $payment_id)
    {
        if (! Gate::allows('payment_access')) {
            return abort(401);
        }

        $data = [];

        $data['items'] = [];
        foreach(Cart::content() as $key=>$cart){
            $itemDetail = [
                'id'=> $cart->id,
                'name'=> $cart->name,
                'price'=>$cart->price,
                'qty'=>$cart->qty
            ];
            $data['items'][]= $itemDetail;
        }
        

        $data['return_url'] = url('/paypal/express-checkout-success');
        $data['invoice_id'] = config('paypal.invoice_prefix') . '_' . $payment_id;
        $data['invoice_description'] = "Order #" . $payment_id . " Invoice";
        $data['cancel_url'] = url('/');
        $data['total'] = 0;
      

        foreach($data['items'] as $item) {
            $data['total'] += $item['price']*$item['qty'];
        }
        $data['total'] =  $data['total'];

        return $data;
        
        
        
       
    }

    public function expressCheckoutSuccess(Request $request) {
        
        if (! Gate::allows('payment_access')) {
            return abort(401);
        }
        // check if payment is recurring
        $recurring = $request::input('recurring', false) ? true : false;

        $token = $request::get('token');

        $PayerID = $request::get('PayerID');

        // initaly we paypal redirects us back with a token
        // but doesn't provice us any additional data
        // so we use getExpressCheckoutDetails($token)
        // to get the payment details
        $response = $this->provider->getExpressCheckoutDetails($token);
        
    

        // if response ACK value is not SUCCESS or SUCCESSWITHWARNING
        // we return back with error
        if (!in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {
            return redirect('/')->with(['code' => 'danger', 'message' => 'Error processing PayPal payment']);
        }

        // invoice id is stored in INVNUM
        // because we set our invoice to be xxxx_id
        // we need to explode the string and get the second element of array
        // witch will be the id of the invoice
        $payment_id = explode('_', $response['INVNUM'])[1];

        // get cart data
        $cart = $this->getCart($recurring, $payment_id);

        // check if our payment is recurring
        if ($recurring === true) {
            
            // if recurring then we need to create the subscription
            // you can create monthly or yearly subscriptions
            $response = $this->provider->createMonthlySubscription($response['TOKEN'], $response['AMT'], $cart['subscription_desc']);
            
            $status = 'Invalid';
            // if after creating the subscription paypal responds with activeprofile or pendingprofile
            // we are good to go and we can set the status to Processed, else status stays Invalid
            if (!empty($response['PROFILESTATUS']) && in_array($response['PROFILESTATUS'], ['ActiveProfile', 'PendingProfile'])) {
                $status = 'Processed';
            }

        } else {

            // if payment is not recurring just perform transaction on PayPal
            // and get the payment status
            $payment_status = $this->provider->doExpressCheckoutPayment($cart, $token, $PayerID);
            $status = $payment_status['PAYMENTINFO_0_PAYMENTSTATUS'];

        }

        // find invoice by id
        $payment = Payment::find($payment_id);

        // set invoice status
        $payment->payment_status = $status;

        // if payment is recurring lets set a recurring id for latter use
        if ($recurring === true) {
            $payment->recurring_id = $response['PROFILEID'];
        }

        // save the invoice
        $payment->save();

        $payment->email; // This is the email you want to send to.
        $payment->notify(new TemplateEmail());
        


        // App\Invoice has a paid attribute that returns true or false based on payment status
        // so if paid is false return with error, else return with success message
        if ($payment->payment_status=="Completed") {
            Session::flash('success', 'Ticket with order ' . $payment->id . ' has been paid successfully!');
            return back();
        }
        if ($payment->payment_status=="Pending") {
            Session::flash('success', 'Ticket with order ' . $payment->id . ' has been pended!');
            return back();
        }
        Session::flash('danger', 'Error processing PayPal payment for ticket Order ' . $payment->id . '!');
        return back();  
           
    }
}


