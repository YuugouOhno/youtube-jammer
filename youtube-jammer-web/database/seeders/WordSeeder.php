<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;

class WordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 初期登録されている単語
        DB::table('words')->insert([
            'user_id' => 1,
            'en_word' => "apple",
            'ja_word' => "りんご",
            'en_sentence' => "I ate an apple",
            'ja_sentence' => "私はりんごを食べた",
            'description' => "名詞、キティちゃんの3分の1のおもさ",
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        DB::table('words')->insert([
            'user_id' => 1,
            'en_word' => "banana",
            'ja_word' => "バナナ",
            'en_sentence' => "I ate an banana",
            'ja_sentence' => "私はバナナを食べた",
            'description' => "名詞、黄色い",
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        DB::table('words')->insert([
            'user_id' => 1,
            'en_word' => "chocolate",
            'ja_word' => "チョコ",
            'en_sentence' => "I ate an chocolate",
            'ja_sentence' => "私はチョコを食べた",
            'description' => "名詞、甘い",
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);

        // 追加した単語
        DB::table('words')->insert([
            'user_id' => 2,
            'en_word' => "anachronism",
            'ja_word' => "過去の遺物、時代錯誤",
            'en_sentence' => "constitutional anachronism",
            'ja_sentence' => "憲法における時代錯誤",
            'description' => "名詞、難しい英単語と検索したら1個目に出てきた",
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        
    }
}
