<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * Only the admin account is created. Categories, products and
     * customers start empty and are added through the app.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->state([
            'role' => 'admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('admin123'),
        ])->create();
    }
}
