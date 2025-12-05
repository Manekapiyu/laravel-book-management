<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'User',
            'email' => 'manekapiyumawali@gmail.com',
            'password' => bcrypt('password'), 
            'member_id' => 'M0001',
            'phone' => '0771234567',
        ]);
    }
}
