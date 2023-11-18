<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // disable foreign key checks
         DB::statement('SET FOREIGN_KEY_CHECKS=0;');
         // truncate the table if it has data.
         DB::table('users')->truncate();
         DB::table('users')->insert([
             'name' => 'Super Admin',
             'email' =>'hellomomanyi@gmail.com',
             'password' => Hash::make('tochange'),
             'email_verified_at' => Carbon::now(),
         ]);
         // enable foreign key checks
         DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
