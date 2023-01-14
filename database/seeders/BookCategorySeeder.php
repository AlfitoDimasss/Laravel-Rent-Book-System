<?php

namespace Database\Seeders;

use App\Models\BookCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BookCategory::insert([
            'book_id' => 1,
            'category_id' => 2
        ]);
        BookCategory::insert([
            'book_id' => 1,
            'category_id' => 7
        ]);
        BookCategory::insert([
            'book_id' => 2,
            'category_id' => 3
        ]);
        BookCategory::insert([
            'book_id' => 2,
            'category_id' => 6
        ]);
    }
}
