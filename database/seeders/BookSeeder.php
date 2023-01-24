<?php

namespace Database\Seeders;

use App\Models\Book;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Book::insert([
            'book_code' => 'A01',
            'title' => 'Majalah Bobo',
            'slug' => 'majalah-bobo',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        Book::insert([
            'book_code' => 'A02',
            'title' => 'Journal Into Mystery',
            'slug' => 'journal-mystery',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
