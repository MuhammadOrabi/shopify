<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function files()
    {
        return $this->morphToMany('App\Models\File', 'fileable');
    }

    public function items()
    {
        return $this->hasMany('App\Models\Item');
    }

    public function tags()
    {
        return $this->morphToMany('App\Models\Tag', 'taggable');
    }

    public function images()
    {
        return $this->files()->whereType('image')->get();
    }
}
