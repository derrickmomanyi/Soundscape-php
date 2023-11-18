<?php

namespace Database\Seeders;

use App\Services\StaticVariables;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // disable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        // truncate the table if it has data.
        DB::table('roles')->truncate();
        DB::table('roles')->insert([           
            [
                'name' => StaticVariables::SUPER_ADMIN_ROLE,
                'guard_name' => StaticVariables::GUARD_ADMIN
            ],
            [
                'name' => StaticVariables::LISTENER_ROLE,
                'guard_name' => StaticVariables::GUARD_LISTENER
            ]
        ]);
    }
}
