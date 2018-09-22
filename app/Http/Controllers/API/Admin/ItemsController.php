<?php

namespace App\Http\Controllers\API\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\ItemsRepository;
use App\Models\Item;

class ItemsController extends Controller
{
    public $rules = [
        'title' => 'required|string|max:255',
        'category' => 'required|exists:categories,id',
        'slug' => 'required|string|unique:items',
        'description' => 'required|string',
        'tags' => 'array',
        'images' => 'array',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('view', Item::class);
        $items = ItemsRepository::get();
        return response()->json(compact('items'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Item::class);
        $request->validate($this->rules);

        ItemsRepository::create();

        $message = __('admin.created', ['module' => 'Item']);
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
        $this->authorize('update', Item::class);
        $this->rules['slug'] = 'required|string';
        $request->validate($this->rules);

        ItemsRepository::update($id);

        $message = __('admin.updated', ['module' => 'Item']);
        return response()->json(['message' => $message]);
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
    }
}
