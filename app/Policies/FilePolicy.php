<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\File;
use Illuminate\Auth\Access\HandlesAuthorization;

class FilePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the file.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\File  $file
     * @return mixed
     */
    public function view(Admin $admin)
    {
        if ($admin->getRole('File', 'view')) {
            return true;
        }
    }

    /**
     * Determine whether the user can create Files.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(Admin $admin)
    {
        if ($admin->getRole('File', 'create')) {
            return true;
        }
    }

    /**
     * Determine whether the user can update the File.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\File  $File
     * @return mixed
     */
    public function update(Admin $admin)
    {
        if ($admin->getRole('File', 'update')) {
            return true;
        }
    }

    /**
     * Determine whether the user can delete the File.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\File  $File
     * @return mixed
     */
    public function delete(Admin $admin)
    {
        if ($admin->getRole('File', 'delete')) {
            return true;
        }
    }

    /**
     * Determine whether the user can restore the File.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\File  $File
     * @return mixed
     */
    public function restore(Admin $admin)
    {
        if ($admin->getRole('File', 'restore')) {
            return true;
        }
    }

    /**
     * Determine whether the user can permanently delete the File.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\File  $File
     * @return mixed
     */
    public function forceDelete(Admin $admin)
    {
        //
    }
}
