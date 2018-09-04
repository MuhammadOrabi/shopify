<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['title', 'slug'];

    /**
     * The admins that belong to the role.
     */
    public function admins()
    {
        return $this->belongsToMany('App\Models\Admin');
    }

    /**
     * The users that belong to the role.
     */
    public function permissions()
    {
        return $this->belongsToMany('App\Models\Permission');
    }
}
