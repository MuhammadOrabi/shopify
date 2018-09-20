<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use SoftDeletes;

    public $guarded = [];

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function files()
    {
        return $this->morphToMany('App\Models\File', 'fileable');
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
