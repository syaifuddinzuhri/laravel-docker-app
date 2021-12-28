<?php

namespace Database\Seeders;

use App\Models\Admin;
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
        // \App\Models\User::factory(10)->create();
        Admin::create([
            'nama' => 'Admin JTI',
            'email' => 'admin@gmail.com',
            'password' => 'admin1234',
            'no_hp' => '085123456789',
        ]);
    }
}
