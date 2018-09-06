<?php

use App\Models\Permission;
use Illuminate\Database\Seeder;

class AdminPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::updateOrCreate(['title' => 'View', 'slug' => 'view', 'model' => 'Admins']);
        Permission::updateOrCreate(['title' => 'Create', 'slug' => 'create', 'model' => 'Admins']);
        Permission::updateOrCreate(['title' => 'Update', 'slug' => 'update', 'model' => 'Admins']);
        Permission::updateOrCreate(['title' => 'Delete', 'slug' => 'delete', 'model' => 'Admins']);
    }
}