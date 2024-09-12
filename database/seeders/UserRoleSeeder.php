<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserRoleSeeder extends Seeder
{
    public const PAYROLL_PERSONNEL = 'PP';
    public const INVENTORY_PERSONNEL = 'IP';

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /**
         * paulnoarah
         * bflores
         * jtomas
         */

        $users = DB::table('users')->get();

        $ppId = DB::table('roles')
            ->select('id')
            ->where('role_code', '=', self::PAYROLL_PERSONNEL)
            ->first();

        $ipId = DB::table('roles')
            ->select('id')
            ->where('role_code', '=', self::INVENTORY_PERSONNEL)
            ->first();

        foreach ($users as $user) {
            if ($user->username === 'jtomas') {
                DB::table('user_roles')->insert([
                    [
                        'user_id' => $user->id,
                        'role_id' => $ipId->id,
                    ]
                ]);
            } else {
                DB::table('user_roles')->insert([
                    [
                        'user_id' => $user->id,
                        'role_id' => $ppId->id,
                    ]
                ]);
            }
        }
    }
}
