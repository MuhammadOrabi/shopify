<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Item;
use Illuminate\Auth\Access\HandlesAuthorization;

class ItemPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the admin can view the item.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Item  $item
     * @return mixed
     */
    public function view(Admin $admin)
    {
        if ($admin->getRole('Item', 'view')) {
            return true;
        }
    }

    /**
     * Determine whether the admin can create items.
     *
     * @param  \App\Models\Admin  $admin
     * @return mixed
     */
    public function create(Admin $admin)
    {
        if ($admin->getRole('Item', 'create')) {
            return true;
        }
    }

    /**
     * Determine whether the admin can update the item.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Item  $item
     * @return mixed
     */
    public function update(Admin $admin)
    {
        if ($admin->getRole('Item', 'update')) {
            return true;
        }
    }

    /**
     * Determine whether the admin can delete the item.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Item  $item
     * @return mixed
     */
    public function delete(Admin $admin)
    {
        if ($admin->getRole('Item', 'delete')) {
            return true;
        }
    }

    /**
     * Determine whether the admin can restore the item.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Item  $item
     * @return mixed
     */
    public function restore(Admin $admin)
    {
        if ($admin->getRole('Item', 'restore')) {
            return true;
        }
    }

    /**
     * Determine whether the admin can permanently delete the item.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Item  $item
     * @return mixed
     */
    public function forceDelete(Admin $admin)
    {
        if ($admin->getRole('Item', 'force-delete')) {
            return true;
        }
    }
}
