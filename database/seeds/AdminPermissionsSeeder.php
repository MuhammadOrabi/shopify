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
        Permission::updateOrCreate(['title' => 'View', 'slug' => 'view', 'model' => 'Admin']);
        Permission::updateOrCreate(['title' => 'Create', 'slug' => 'create', 'model' => 'Admin']);
        Permission::updateOrCreate(['title' => 'Update', 'slug' => 'update', 'model' => 'Admin']);
        Permission::updateOrCreate(['title' => 'Delete', 'slug' => 'delete', 'model' => 'Admin']);
        Permission::updateOrCreate(['title' => 'Restore', 'slug' => 'restore', 'model' => 'Admin']);

        Permission::updateOrCreate(['title' => 'View', 'slug' => 'view', 'model' => 'Category']);
        Permission::updateOrCreate(['title' => 'Create', 'slug' => 'create', 'model' => 'Category']);
        Permission::updateOrCreate(['title' => 'Update', 'slug' => 'update', 'model' => 'Category']);
        Permission::updateOrCreate(['title' => 'Delete', 'slug' => 'delete', 'model' => 'Category']);
        Permission::updateOrCreate(['title' => 'Restore', 'slug' => 'restore', 'model' => 'Category']);

        Permission::updateOrCreate(['title' => 'View', 'slug' => 'view', 'model' => 'File']);
        Permission::updateOrCreate(['title' => 'Create', 'slug' => 'create', 'model' => 'File']);
        Permission::updateOrCreate(['title' => 'Update', 'slug' => 'update', 'model' => 'File']);
        Permission::updateOrCreate(['title' => 'Delete', 'slug' => 'delete', 'model' => 'File']);
        Permission::updateOrCreate(['title' => 'Restore', 'slug' => 'restore', 'model' => 'File']);
    }
}
