<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Category;
use Illuminate\Http\Request;
use \App\Repositories\Categories;

class CategoriesController extends Controller
{

    public $rules = [
        'title' => 'required|string|max:255',
        'slug' => 'required|string|unique:categories',
        'description' => 'required|string',
        'tags' => 'array',

    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
        $this->authorize('create', Category::class);
        $request->validate($this->rules);

        $category = Categories::create();

        $message = __('admin.category-created');
        return response()->json(['message' => $message]);
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->authorize('update', Category::class);
        $this->rules['slug'] = 'required|string';
        $request->validate($this->rules);

        Categories::update($id);

        $message = __('admin.category-updated');
        return response()->json(['message' => $message]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($category)
    {
        $this->authorize('delete', Category::class);
        Category::whereId($category)->delete();
        return response()->json();
    }


    public function restore($id)
    {
        $this->authorize('restore', Category::class);
        Category::onlyTrashed()->where('id', $id)->restore();
        return response()->json();
    }
}
