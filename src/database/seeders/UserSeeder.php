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
        //Delete the existing user table data
        DB::table('users')->delete();

        DB::table('users')->insert([
            [
                'name' => 'Admin',
                'profile_pic' => 'default.jpg',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin123'),
                'phoneNo' => '012-1234568',
                'address' => '',
                'created_at' => now(),
                'updated_at' => now(),
                'role' => 'admin',
            ],
            [
                'name' => 'Peter Lee',
                'profile_pic' => '1680534822_p1.jpg',
                'email' => 'peter@gmail.com',
                'password' => Hash::make('abcd1234'),
                'phoneNo' => '011-12345678',
                'address' => 'Sample 1,Taman Sample 1,Negeri Sample 1',
                'created_at' => now(),
                'updated_at' => now(),
                'role' => 'user',
            ],
            [
                'name' => 'John Ma',
                'profile_pic' => '1680515461_sample1.jpg',
                'email' => 'john@utar.edu.my',
                'password' => Hash::make('qwerty123'),
                'phoneNo' => '013-1456789',
                'address' => 'Sample 2,Taman Sample 2,Negeri Sample 2',
                'created_at' => now(),
                'updated_at' => now(),
                'role' => 'user',
            ],
        ]);
    }
}
