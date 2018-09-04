<?php

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $super = Role::updateOrCreate(['title' => 'Super Admin', 'slug' => 'super-admin']);
        $permissions = Permission::all()->pluck('id')->toArray();
        $super->permissions()->sync($permissions);
        Role::updateOrCreate(['title' => 'Admin', 'slug' => 'admin']);
    }
}
