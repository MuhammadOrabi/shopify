<?php

namespace App\Policies;

use App\Models\Admin;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdminPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the admin can view the admin.
     *
     * @param  \App\Models\Admin  $admin
     * @return mixed
     */
    public function view(Admin $admin)
    {
        if ($admin->getRole('Admins', 'view')) {
            return true;
        }
    }

    /**
     * Determine whether the admin can create admins.
     *
     * @param  \App\Models\Admin  $admin
     * @return mixed
     */
    public function create(Admin $admin)
    {
        if ($admin->getRole('Admins', 'create')) {
            return true;
        }
    }

    /**
     * Determine whether the admin can update the admin.
     *
     * @param  \App\Models\Admin  $admin
     * @return mixed
     */
    public function update(Admin $admin)
    {
        if ($admin->getRole('Admins', 'update')) {
            return true;
        }
    }

    /**
     * Determine whether the admin can delete the admin.
     *
     * @param  \App\Models\Admin  $admin
     * @return mixed
     */
    public function delete(Admin $admin)
    {
        if ($admin->getRole('Admins', 'delete')) {
            return true;
        }
    }

    /**
     * Determine whether the admin can restore the admin.
     *
     * @param  \App\Models\Admin  $admin
     * @return mixed
     */
    public function restore(Admin $admin)
    {
        //
    }

    /**
     * Determine whether the admin can permanently delete the admin.
     *
     * @param  \App\Models\Admin  $admin
     * @return mixed
     */
    public function forceDelete(Admin $admin)
    {
        //
    }
}
