<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userData = [
            [
                'first_name' => 'Noarah',
                'last_name' => 'Paul',
                'mobile' => '',
                'username' => 'paulnoarah',
                'email' => 'paulnoarah@gmail.com',
                'password' => Hash::make('noarah123'),
            ],
            [
                'first_name' => 'Bryan',
                'last_name' => 'Flores',
                'mobile' => '',
                'username' => 'bflores',
                'email' => 'dugoy1949@gmail.com',
                'password' => Hash::make('password'),
            ],
            [
                'first_name' => 'Jeramel',
                'last_name' => 'Tomas',
                'mobile' => '',
                'username' => 'jtomas',
                'email' => 'jerameltomas@gmail.com',
                'password' => Hash::make('jeramelt123'),
            ],
        ];
        
        DB::table('users')->insert($userData);
    }
}
