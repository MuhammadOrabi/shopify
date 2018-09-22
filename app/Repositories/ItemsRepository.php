<?php

namespace App\Repositories;

use App\Models\Category;
use App\Models\Tag;
use App\Models\Item;

class ItemsRepository
{

    public static function __callStatic($method, $parameters)
    {
        return (new static)->$method(...$parameters);
    }

    private function get()
    {
        $items = Item::withTrashed()->with('tags', 'files', 'category')->orderBy('id', 'desc');
        return $this->filter($items);
    }

    private function create()
    {
        $category = Category::findOrFail(request('category'));

        $item = $category->items()->create([
            'title' => request('title'),
            'slug' => request('slug'),
            'description' => request('description')
        ]);

        $this->images($item);
        $this->tags($item);

        return $item;
    }

    private function update($id)
    {
        $item = Item::findOrFail($id);
        $item->title = request('title');
        $item->slug = request('slug');
        $item->description = request('description');
        $item->category_id = request('category');
        $item->save();

        $this->images($item);
        $this->tags($item);

        return $item;
    }

    private function filter($items)
    {
        if (request()->has('category_id') && !is_null(request('category_id'))) {
            $items->where('category_id', request()->query('category_id'));
        }
        return $items->paginate(config('options.paginate'));
    }

    private function images($item)
    {
        $item->files()->whereType('image')->detach();
        foreach (request('images') as $image) {
            $item->files()->syncWithoutDetaching($image);
        }
    }

    private function tags($item)
    {
        $item->tags()->detach();
        list($tagArray, $tagString) = collect(request('tags'))->partition(function ($tag) {
            return is_array($tag);
        });

        foreach ($tagString as $tag) {
            $tag = Tag::firstOrCreate(['title' => $tag, 'type' => 'tag']);
            $item->tags()->syncWithoutDetaching($tag->id);
        }

        foreach ($tagArray as $tag) {
            $item->tags()->syncWithoutDetaching($tag['id']);
        }
    }
}
