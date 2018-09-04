<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Permissions
        $this->call(AdminPermissionsSeeder::class);

        // Roles
        $this->call(RolesSeeder::class);

        // Admins
        $this->call(AdminUsers::class);
    }
}
