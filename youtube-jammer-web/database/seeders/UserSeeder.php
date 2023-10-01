<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use DateTime;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // adminユーザー
        DB::table('users')->insert([
            'name' => "admin",
            'email' => "admin@admin",
            'password' => Hash::make('password'),
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);

        // 一般ユーザーの想定 
        DB::table('users')->insert([
            'name' => "test",
            'email' => "test@test",
            'password' => Hash::make('testtest'),
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
    }
}
