<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ユーザーが生成されると初期登録の分の単語に対応したtagを全て生成する？
        DB::table('tags')->insert([
            'word_id' => 1,
            'user_id' => 2,
            'level' => 1,
            'is_show' => 1,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        DB::table('tags')->insert([
            'word_id' => 2,
            'user_id' => 2,
            'level' => 1,
            'is_show' => 1,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        DB::table('tags')->insert([
            'word_id' => 3,
            'user_id' => 2,
            'level' => 1,
            'is_show' => 1,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        DB::table('tags')->insert([
            'word_id' => 4,
            'user_id' => 2,
            'level' => 1,
            'is_show' => 1,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);

    }
}
