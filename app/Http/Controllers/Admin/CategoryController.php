<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Category;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if (! Gate::allows('category_access')) {
            return abort(401);
        }
        $categories = Category::all();
        return view('admin.events.categories.index', compact('categories'));
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
        if (! Gate::allows('category_create')) {
            return abort(401);
        }
        $this->validate($request, [
            'name' => 'required',
        ]);
        Category::create($request->all());
        return redirect()->route('admin.categories.index');

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
        if (! Gate::allows('category_view')) {
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
        if (! Gate::allows('category_edit')) {
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
        if (! Gate::allows('category_edit')) {
            return abort(401);
        }
        $category=Category::find($id);
        $category->update($request->all());
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
        //
        if (! Gate::allows('category_delete')) {
            return abort(401);
        }
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->route('admin.categories.index');
    }

    public function massDestroy(Request $request){

        if (! Gate::allows('category_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Category::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }
}
