<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Nevin',
            'email' => 'nevin@gmail.com',
            'password' => bcrypt('Nevin#123pass'),  
            'role' => 'project_manager'
        ]);

        User::create([
            'name' => 'Heba',
            'email' => 'heba@gmail.com',
            'password' => bcrypt('Heba#123pass'),  
            'role' => 'admin'
        ]);

        User::create([
            'name' => 'Rashid',
            'email' => 'rashid@gmail.com',
            'password' => bcrypt('Rashid#123pass'),  
            'role' => 'user'
        ]);
    }
}
