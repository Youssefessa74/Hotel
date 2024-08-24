<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'role_level' => 2,
        ]);

        User::create([
            'name' => 'Super Admin',
            'email' => 'super_admin@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'role_level' => 5,
        ]);



        User::create([
            'name' => 'User',
            'email' => 'user@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'user',
            'role_level' => 1,
        ]);


    }
    }

