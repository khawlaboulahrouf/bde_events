<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'Admin',
            'lastname' => 'BDE',
            'email' => 'admin@bde.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        // Étudiant 1
        User::create([
            'name' => 'Khawla',
            'lastname' => 'Boulahrouf',
            'email' => 'khawla@bde.com',
            'password' => bcrypt('password'),
            'role' => 'student',
        ]);

        // Étudiant 2
        User::create([
            'name' => 'Yassine',
            'lastname' => 'Alaoui',
            'email' => 'yassine@bde.com',
            'password' => bcrypt('password'),
            'role' => 'student',
        ]);

        // Étudiant 3
        User::create([
            'name' => 'Sara',
            'lastname' => 'Idrissi',
            'email' => 'sara@bde.com',
            'password' => bcrypt('password'),
            'role' => 'student',
        ]);

        // Étudiant 4
        User::create([
            'name' => 'Amine',
            'lastname' => 'Benali',
            'email' => 'amine@bde.com',
            'password' => bcrypt('password'),
            'role' => 'student',
        ]);

        // Étudiant 5
        User::create([
            'name' => 'Fatima',
            'lastname' => 'Zahra',
            'email' => 'fatima@bde.com',
            'password' => bcrypt('password'),
            'role' => 'student',
        ]);

        // Étudiant 6
        User::create([
            'name' => 'Omar',
            'lastname' => 'belai',
            'email' => 'omar@bde.com',
            'password' => bcrypt('password'),
            'role' => 'student',
        ]);
    }
}
