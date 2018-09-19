<?php

namespace App\Repositories;

use App\Models\Category;
use App\Models\Tag;

class CategoriesRepository
{

    public static function __callStatic($method, $parameters)
    {
        return (new static)->$method(...$parameters);
    }

    private function create()
    {
        $category = Category::create([
            'title' => request('title'),
            'slug' => request('slug'),
            'description' => request('description')
        ]);

        $this->images($category);
        $this->tags($category);

        return $category;
    }

    private function images($category)
    {
        $category->files()->whereType('image')->detach();
        foreach (request('images') as $image) {
            $category->files()->syncWithoutDetaching($image);
        }
    }

    private function tags($category)
    {
        $category->tags()->detach();
        list($tagArray, $tagString) = collect(request('tags'))->partition(function ($tag) {
            return is_array($tag);
        });

        foreach ($tagString as $tag) {
            $tag = Tag::firstOrCreate(['title' => $tag, 'type' => 'tag']);
            $category->tags()->syncWithoutDetaching($tag->id);
        }

        foreach ($tagArray as $tag) {
            $category->tags()->syncWithoutDetaching($tag['id']);
        }
    }

    private function update($id)
    {
        $category = Category::findOrFail($id);
        $category->title = request('title');
        $category->slug = request('slug');
        $category->description = request('description');
        $category->save();

        $this->images($category);
        $this->tags($category);

        return $category;
    }
}
