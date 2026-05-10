<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'is_admin' => 1,
            'country_code' => '+91',
            'phone_number' =>'0123456789',
            'is_verified'=> 1,
            'password' => Hash::make('password')


        ]);
    }
}
