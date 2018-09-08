<?php

namespace App\Policies;

use App\Models\Admin;
use App\Category;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoryPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the category.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Category  $category
     * @return mixed
     */
    public function view(Admin $admin)
    {
        if ($admin->getRole('Categories', 'view')) {
            return true;
        }
    }

    /**
     * Determine whether the user can create categories.
     *
     * @param  \App\Models\Admin  $admin
     * @return mixed
     */
    public function create(Admin $admin)
    {
        if ($admin->getRole('Categories', 'create')) {
            return true;
        }
    }

    /**
     * Determine whether the user can update the category.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Category  $category
     * @return mixed
     */
    public function update(Admin $admin)
    {
        if ($admin->getRole('Categories', 'update')) {
            return true;
        }
    }

    /**
     * Determine whether the user can delete the category.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Category  $category
     * @return mixed
     */
    public function delete(Admin $admin)
    {
        if ($admin->getRole('Categories', 'delete')) {
            return true;
        }
    }

    /**
     * Determine whether the user can restore the category.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Category  $category
     * @return mixed
     */
    public function restore(Admin $admin)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the category.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Category  $category
     * @return mixed
     */
    public function forceDelete(Admin $admin)
    {
        //
    }
}
