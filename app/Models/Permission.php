<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = ['title', 'slug', 'model'];

    /**
     * The roles that belong to the admin.
     */
    public function roles()
    {
        return $this->belongsToMany('App\Models\Role');
    }
}
