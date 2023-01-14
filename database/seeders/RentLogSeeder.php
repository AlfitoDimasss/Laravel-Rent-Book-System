<?php

namespace Database\Seeders;

use App\Models\RentLog;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RentLogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RentLog::insert([
            'user_id' => 2,
            'book_id' => 2,
            'rent_date' => Carbon::now(),
            'return_date' => Carbon::now()
        ]);
    }
}
