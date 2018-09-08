<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    protected $dates = ['deleted_at'];

    public function images()
    {
        return $this->morphMany('App\Models\Image', 'imageable');
    }

    public function items()
    {
        return $this->hasMany('App\Models\Item');
    }

    public function tags()
    {
        return $this->morphMany('App\Models\Tag', 'tagable');
    }
}