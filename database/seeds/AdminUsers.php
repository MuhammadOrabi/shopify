<?php

use App\Models\Admin;
use App\Models\Role;
use Illuminate\Database\Seeder;

class AdminUsers extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Admin::updateOrCreate([
            'name' => 'Admin',
            'email' => 'admin@app.com'
        ], ['password' => Hash::make('password')]);

        $adminsRoles = Role::where('slug', 'super-admin')->pluck('id')->toArray();
        $admin->roles()->sync($adminsRoles);
    }
}
