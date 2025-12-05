<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BookCate;

class BookCateSeeder extends Seeder
{
    public function run()
    {
        $categories = [
            'Science Fiction',
            'Mathematics',
            'History',
            'Programming',
            'Biography',
        ];

        foreach ($categories as $name) {
            BookCate::create(['name' => $name]);
        }
    }
}
