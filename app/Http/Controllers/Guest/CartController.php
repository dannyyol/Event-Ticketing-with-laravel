<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use App\Ticket;
use Gloudemans\Shoppingcart\Facades\Cart;
//use Darryldecode\Cart\Cart;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Show all collections of CART
        //$cartItems = \Cart::getContent();
//        return view('shop.cart.index', compact('cartItems'));
          /*$cartItems=*/
          $cartItems = Cart::content();
          return view('guest.home', compact('cartItems'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // creating CART



    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //

    }
    public function addItem($id){
      $ticket = Ticket::find($id);
    //   dd(Cart::content());
      Cart::add($id, $ticket->title, 1, $ticket->price);

//      \Cart::add($id, $product->name, $product->price, 1, ['size' => 'medium']);

       return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //Update cart
        Cart::update($id, ['qty'=>$request->qty, "options"=>['size'=>$request->size]]);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // To delete item
        Cart::remove($id);
        return back();
    }
}
