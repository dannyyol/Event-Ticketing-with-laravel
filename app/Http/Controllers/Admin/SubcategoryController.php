<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Subcategory;
use App\Category;

class SubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Category $id)
    {
        //
        if (! Gate::allows('subcategory_access')) {
            return abort(401);
        }
        $subcategories = Subcategory::all();
        $category = Category::pluck('name', 'id');
        return view('admin.events.subcategories.index', compact('subcategories', 'category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        if (! Gate::allows('subcategory_create')) {
            return abort(401);
        }
        $this->validate($request, [
            'title' => 'required',
        ]);
        Subcategory::create($request->all());
        return redirect()->route('admin.subcategories.index');
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
        if (! Gate::allows('subcategory_view')) {
            return abort(401);
        }
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
        if (! Gate::allows('subcategory_edit')) {
            return abort(401);
        }
        $category = Category::find($id);
        return view('admin.events.categories.edit',compact('category'));
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
        //
        if (! Gate::allows('subcategory_edit')) {
            return abort(401);
        }

        $subcategory=Subcategory::find($id);
        $subcategory->update($request->all());
        return redirect()->route('admin.subcategories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        if (! Gate::allows('subcategory_delete')) {
            return abort(401);
        }
        $subcategory = Subcategory::findOrFail($id);
        $subcategory->delete();
        return redirect()->route('admin.subcategories.index');
    }

    public function massDestroy(Request $request){

        if (! Gate::allows('subcategory_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Subcategory::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }
}
