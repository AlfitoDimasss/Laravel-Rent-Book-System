<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = ['action', 'sci-fi', 'mystery', 'fabel', 'adventure', 'novel', 'magazine', 'book'];
        foreach ($data as $val) {
            Category::insert([
                'category' => $val,
                'slug' => $val
            ]);
        }
    }
}
