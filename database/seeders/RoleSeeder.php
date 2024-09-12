<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            [
                'role_code' => 'PP', 
                'role_description' => 'Payroll Personnel',
            ],
            [
                'role_code' => 'IP',
                'role_description' => 'Inventory Personnel',
            ]
        ]);
    }
}
