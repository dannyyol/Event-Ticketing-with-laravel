<?php

namespace App\Http\Controllers\Admin;

use App\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreEventsRequest;
use App\Http\Requests\Admin\UpdateEventsRequest;
// use Illuminate\Support\Facades\Storage;
use App\Category;
use App\Subcategory;
use File;

class EventsController extends Controller
{
    /**
     * Display a listing of Event.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('event_access')) {
            return abort(401);
        }

        $events = Event::all();
        // foreach($events as $event){
        //     dd($event->subcategories);
        // }

        return view('admin.events.index', compact('events'));
    }

    /**
     * Show the form for creating new Event.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('event_create')) {
            return abort(401);
        }
        $category = Category::pluck('name', 'id');
        $subcategory = Subcategory::pluck('title', 'id');
        return view('admin.events.create', compact('category', 'subcategory'));
    }

    /**
     * Store a newly created Event in storage.
     *
     * @param  \App\Http\Requests\StoreEventsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEventsRequest $request)
    {
        // $this->validate($request, [
        //     'photo.*' => 'image|mimes:png,jpg,jpeg|max:10000'
        // ]);

        if (! Gate::allows('event_create')) {
            return abort(401);
        }

        $event = Event::create($request->all());

        // edited
        if($request->hasfile('photo'))
            {           
            $image = $request->file('photo');
            $name=time(). '.' .$image->getClientOriginalName();
            $image->move(public_path().'/images/events/', $name);
            $event->photo = $name;
            $event->save();
        }
        return redirect()->route('admin.events.index')->with('success', 'Your message has been sent successfully!');
    }


    /**
     * Show the form for editing Event.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('event_edit')) {
            return abort(401);
        }
        $event = Event::findOrFail($id);
        $subcategory = Subcategory::pluck('title', 'id');
        $category = Category::pluck('name', 'id');
        return view('admin.events.edit', compact('event', 'subcategory','category'));
    }

    /**
     * Update Event in storage.
     *
     * @param  \App\Http\Requests\UpdateEventsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEventsRequest $request, $id)
    {
        if (! Gate::allows('event_edit')) {
            return abort(401);
        }
        $event = Event::findOrFail($id);
        $event->title = $request->input('title');
        $event->description = $request->input('description');
        $event->start_time = $request->input('start_time');
        $event->venue = $request->input('venue');
        $event->category_id = $request->input('category_id');
        $event->subcategory_id = $request->input('subcategory_id');
        // edited
        if($request->hasfile('photo'))
            {           
            $image = $request->file('photo');
            $name=time(). '.' .$image->getClientOriginalName();
            $image->move(public_path().'/images/events/', $name);
            $oldPhoto = $event->photo;
            $event->photo = $name;
            $image_path = public_path().'/images/events/'.$oldPhoto;
            // dd($image_path);
            File::delete($image_path);
            $event->save();
        }
        // $event->update($request->all());




        return redirect()->route('admin.events.index');
    }


    /**
     * Display Event.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('event_view')) {
            return abort(401);
        }
        $tickets = \App\Ticket::where('event_id', $id)->get();

        $event = Event::findOrFail($id);

        return view('admin.events.show', compact('event', 'tickets'));
    }


    /**
     * Remove Event from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('event_delete')) {
            return abort(401);
        }
        $event = Event::findOrFail($id);
        $event->delete();

        return redirect()->route('admin.events.index');
    }

    /**
     * Delete all selected Event at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('event_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Event::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
