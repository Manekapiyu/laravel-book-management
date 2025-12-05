<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\BookCateSeeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            BookCateSeeder::class,
            UserSeeder::class,
        ]);
    }
}
