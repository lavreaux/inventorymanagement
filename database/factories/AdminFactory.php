<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class AdminFactory extends Factory
{
    protected $model = \App\Models\User::class;

    public function definition()
    {
        return [
            'name' => 'Admin ' . $this->faker->firstName(),
            'email' => 'admin@example.com',
            'email_verified_at' => now(),
            'password' => bcrypt('admin123'),
            'role' => 'admin',
            'phone' => '08' . $this->faker->numerify('########'),
            'remember_token' => Str::random(10),
        ];
    }
}
