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
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            'username' => 'admin',
            'slug' => 'admin',
            'password' => Hash::make('password'),
            'role_id' => 1,
            'phone' => '081390343422',
            'address' => 'LaraBook',
            'status' => 'active'
        ]);

        User::insert([
            'username' => 'client',
            'slug' => 'client',
            'password' => Hash::make('password'),
            'phone' => '081390343421',
            'address' => 'Citra Gading',
            'status' => 'active'
        ]);
    }
}
