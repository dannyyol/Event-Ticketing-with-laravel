<?php

namespace App\Http\Controllers\Guest;

use App\Category;
use App\Event;
use App\Ticket;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreEventsRequest;
use App\Http\Requests\Admin\UpdateEventsRequest;
use App\Subcategory;
use Illuminate\Support\Facades\DB;
use Gloudemans\Shoppingcart\Facades\Cart;

class EventsController extends Controller
{
    static $sort = 'asc';
    /**
     * Display a listing of Event.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Event $event, Category $categories, Subcategory $subcategories)
    {
        if($request->has('id')){  
            $now = Carbon::now()->toDateString(); //For the current time
        
        // don't display tickets which are not available
        $match = [
            ['event_id', '=', $event],
            ['available_from', '<=', $now],
            ['available_to', '>=', $now]
        ];

        // used collect method to be able to sortBy
        $tickets = Ticket::with('event')->orderBy('price', 'ASC')->get();

        $events= Category::find($request->id)->events()->orderBy('updated_at', 'asc')->paginate(10,['*', 'title']); 
        $events->withPath('?id='.$request->id);
        }

        else if($request->has('ids')){
            // code...
            $categories =Category::all();

            $subcategory = Subcategory::find($request->ids);
            $events = $subcategory->events()->paginate(10);
            // foreach($events as $eventsss){
            //     dd($eventsss->tickets->price);
            // }
            
            $events->withPath('?ids='.$request->ids);
            $tickets = Ticket::with('event')->orderBy('price', 'ASC')->get();

            $subcategories = Subcategory::with('events')->orderBy('updated_at', 'desc')->get();
            $cartItems = Cart::content();
                 
        }
        
        else {
            $categories =Category::all();
            $events = Event::all();
            $e = DB::select('select * FROM events INNER JOIN tickets ON events.id = 
            tickets.event_id ORDER BY PRICE ASC'); 
            $subcategories = Subcategory::with('events')->orderBy('updated_at', 'desc')->get();
            // $Subcategory::withCount('events')->get()
            $tickets = Ticket::with('event')->orderBy('price', 'ASC')->get();
            $cartItems = Cart::content();

        }
        
        if($request->has('low')){
            $events = Event::paginate(1);
            // $e = DB::select('select * FROM events INNER JOIN tickets ON events.id = 
            // tickets.event_id ORDER BY PRICE ASC');            
        }

        if($request->has('high')){
            $events = Event::paginate(5);
            // $e = DB::select('select * FROM events INNER JOIN tickets ON events.id = 
            // tickets.event_id ORDER BY PRICE ASC');
            $e = Ticket::with('event')->orderBy('price', 'ASC')->get();
            
        }


        return view('guest.home', compact('events', 'categories', 'subcategories', 'tickets'));
    }

    /**
     * Display Event.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $now = Carbon::now()->toDateString(); //For the current time
        
        // don't display tickets which are not available
        $match = [
            ['event_id', '=', $id],
            ['available_from', '<=', $now],
            ['available_to', '>=', $now]
        ];

        // used collect method to be able to sortBy
        $tickets = Ticket::where($match)->orderBy('price')->get();

        $event = Event::findOrFail($id);

        return view('guest.events.show', compact('event', 'tickets'));
    }
}
