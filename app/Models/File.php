<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class File extends Model
{
    use SoftDeletes;

    protected $guarded = [];
    protected $casts = [
        'links' => 'array',
    ];


    public function owner()
    {
        $this->morphTo('owner');
    }

    public function categories()
    {
        return $this->morphedByMany('App\Models\Category', 'fileable');
    }
}
