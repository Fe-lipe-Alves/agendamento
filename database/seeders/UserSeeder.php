<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
        DB::table('users')->insert([
            'name' => 'Felipe A.',
            'email' => 'felipealves1550@gmail.com',
            'password' => Hash::make('abcd@123'),
        ]);

        DB::table('users')->insert([
            'name' => 'Lucas A.',
            'email' => 'lucasalves0705@gmail.com',
            'password' => Hash::make('abcd@123'),
        ]);
    }
}
