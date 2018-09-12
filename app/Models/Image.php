<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Image extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function imageable()
    {
        return $this->morphTo();
    }

    public function path()
    {
        return app()->make('firebase')->getUrl($this->url);
        // return app()->make('firebase:bucket')->info()['selfLink'] . '/o/' . $this->url;
    }
}
