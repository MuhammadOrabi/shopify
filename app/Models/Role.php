<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['title', 'slug', 'category'];

    /**
     * The users that belong to the role.
     */
    public function admins()
    {
        return $this->belongsToMany('App\Models\Admin');
    }
}
