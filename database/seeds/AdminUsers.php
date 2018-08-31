<?php

use Illuminate\Database\Seeder;
use App\Models\Admin;

class AdminUsers extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
            'name' => 'Admin',
            'email' => 'admin@app.com',
            'password' => Hash::make('password'),
        ]);
    }
}
