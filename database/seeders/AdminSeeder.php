<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@test.com',
            'password' => Hash::make('test123'),
            'role' =>  'admin'
        ]);

        // DB::table('users')->insert([
        //     'name' => 'test',
        //     'email' => 'test@test.com',
        //     'password' => Hash::make('test123')
            
        // ]);
    }
}
