<?php

namespace App\Http\Controllers\API\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use App\Traits\Firebase;

class CategoriesController extends Controller
{
    use Firebase;
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
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|unique:categories',
            'description' => 'required|string',
            'tags' => 'string',
            'images' => 'array',
        ]);

        $category = Category::create([
            'title' => $request->title,
            'slug' => $request->slug,
            'description' => $request->description
        ]);

        foreach ($request->images as $image) {
            $path = $this->putFileAs('/categories/' . $category->id . '/', $image);
            $category->images()->create([
                'url' => $path,
                'type' => 'image'
            ]);
        }

        $tags = explode(',', $request->tags);
        foreach ($tags as $tag) {
            $category->tags()->create([
                'title' => $tag,
                'type' => 'tag'
            ]);
        }

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
        //
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
