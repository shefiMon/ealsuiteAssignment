<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create default users
        \App\Models\User::updateOrCreate([
            'email' => "admin@example.com",
        ],[
            'name' => "admin",
            'email_verified_at' => now(),
            'password' => bcrypt('123456'), // password
            'remember_token' => Str::random(10),
        ]);
      }
}
