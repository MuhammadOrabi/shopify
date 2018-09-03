<?php

use App\Models\Role;
use Illuminate\Database\Seeder;

class AdminsRoles extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::updateOrCreate(['title' => 'View Admins', 'slug' => 'view', 'category' => 'Admins']);
        Role::updateOrCreate(['title' => 'Create Admins', 'slug' => 'create', 'category' => 'Admins']);
        Role::updateOrCreate(['title' => 'Update Admins', 'slug' => 'update', 'category' => 'Admins']);
        Role::updateOrCreate(['title' => 'Delete Admins', 'slug' => 'delete', 'category' => 'Admins']);
    }
}
