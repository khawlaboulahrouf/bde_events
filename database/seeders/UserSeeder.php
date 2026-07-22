<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'lastname' => 'BDE',
            'email' => 'admin@bde.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Etudiant',
            'lastname' => 'Test',
            'email' => 'student@bde.com',
            'password' => bcrypt('password'),
            'role' => 'student',
        ]);
    }
}
