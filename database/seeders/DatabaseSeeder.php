<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        
        // masterアカウント
        DB::table('users')->insert([
            'name' => 'master1',
            'email' => 'master1@example.com',
            'password' => Hash::make('s32ucemj'),
            'role' => '2',
            'created_at' => '2023-02-17',
            'updated_at' => '2023-02-17',
        ]);
        
        DB::table('users')->insert([
            'name' => 'master2',
            'email' => 'master2@example.com',
            'password' => Hash::make('y3ricg59'),
            'role' => '2',
            'created_at' => '2023-02-18',
            'updated_at' => '2023-02-18',
        ]);
        
        DB::table('users')->insert([
            'name' => 'master3',
            'email' => 'master3@example.com',
            'password' => Hash::make('c7qgxk6m'),
            'role' => '2',
            'created_at' => '2023-02-19',
            'updated_at' => '2023-02-19',
        ]);

        DB::table('users')->insert([
            'name' => 'admin1',
            'email' => 'admin1@example.com',
            'password' => Hash::make('z8qt3dkx'),
            'role' => '1',
            'created_at' => '2023-02-20',
            'updated_at' => '2023-02-20',
        ]);

        DB::table('users')->insert([
            'name' => 'admin2',
            'email' => 'admin2@example.com',
            'password' => Hash::make('i3v2yacz'),
            'role' => '1',
            'created_at' => '2023-02-21',
            'updated_at' => '2023-02-21',
        ]);

        DB::table('users')->insert([
            'name' => 'admin3',
            'email' => 'admin3@example.com',
            'password' => Hash::make('j8ybv4xc'),
            'role' => '1',
            'created_at' => '2023-02-22',
            'updated_at' => '2023-02-22',
        ]);

        DB::table('users')->insert([
            'name' => 'test1',
            'email' => 'test1@example.com',
            'password' => Hash::make('k9rw6dqj'),
            'role' => '0',
            'created_at' => '2023-02-23',
            'updated_at' => '2023-02-23',
        ]);

        DB::table('users')->insert([
            'name' => 'test2',
            'email' => 'test2@example.com',
            'password' => Hash::make('q2tmxjbd'),
            'role' => '0',
            'created_at' => '2023-02-24',
            'updated_at' => '2023-02-24',
        ]);

        DB::table('users')->insert([
            'name' => 'test3',
            'email' => 'test3@example.com',
            'password' => Hash::make('q4a56dsc'),
            'role' => '0',
            'created_at' => '2023-02-25',
            'updated_at' => '2023-02-25',
        ]);
        
        // カテゴリー

        DB::table('categories')->insert([
            'name' => 'no-category',
        ]);

        DB::table('categories')->insert([
            'name' => '青果',
        ]);

        DB::table('categories')->insert([
            'name' => '精肉',
        ]);

        DB::table('categories')->insert([
            'name' => '鮮魚',
        ]);

        // 商品
        DB::table('items')->insert([
            'user_id' => '0',
            'name' => 'ほうれん草',
            'status' => 'active',
            'category_id' => '0',
            'detail' => "ホウレンソウ（ほうれん草）は、緑黄色野菜を代表する野菜。\n栄養豊富でビタミンやカロテン、鉄分、カルシウムなどの含有量が多いことが大きな特徴。",
            'created_at' => '2023-02-17',
            'updated_at' => '2023-02-17',
        ]);

        DB::table('items')->insert([
            'user_id' => '0',
            'name' => '真鯛',
            'status' => 'active',
            'category_id' => '0',
            'detail' => "たい科の代表的な魚。大形、桜色で緑色の斑点(はんてん)がある。\nマダイの旬は3月～6月、9月～11月の2回訪れ、それぞれ呼び名も違い、春頃のマダイを「桜鯛」、秋頃のマダイを「紅葉鯛」と呼ぶ。",
            'created_at' => '2023-02-18',
            'updated_at' => '2023-02-18',
        ]);

        DB::table('items')->insert([
            'user_id' => '0',
            'name' => 'イサキ',
            'status' => 'active',
            'category_id' => '0',
            'detail' => "スズキ目イサキ科に属する海水魚の一種。\n春～夏にかけてが旬で「梅雨イサキ」「麦わらイサキ」と呼ばれ、脂がの って美味。",
            'created_at' => '2023-02-19',
            'updated_at' => '2023-02-19',
        ]);

        DB::table('items')->insert([
            'user_id' => '0',
            'name' => '豚ヒレ肉',
            'status' => 'negative',
            'category_id' => '0',
            'detail' => "ヒレはバラの上の部分にあり、1頭の豚から約1kg程しか取れない高級な部位です。",
            'created_at' => '2023-02-20',
            'updated_at' => '2023-02-20',
        ]);

        DB::table('items')->insert([
            'user_id' => '0',
            'name' => '豚ロース',
            'status' => 'active',
            'category_id' => '0',
            'detail' => "ロースは豚の背中側にある部位です。ロースはきめが細かくて柔らかく、適度に脂肪がついているのが特徴。",
            'created_at' => '2023-02-20',
            'updated_at' => '2023-02-20',
        ]);

        DB::table('items')->insert([
            'user_id' => '0',
            'name' => '豚バラ',
            'status' => 'active',
            'category_id' => '0',
            'detail' => "赤身と脂肪が層になっており柔らかい肉質が特徴。",
            'created_at' => '2023-02-21',
            'updated_at' => '2023-02-21',
        ]);

        DB::table('items')->insert([
            'user_id' => '0',
            'name' => '牛肉',
            'status' => 'negative',
            'category_id' => '0',
            'detail' => "",
            'created_at' => '2023-02-21',
            'updated_at' => '2023-02-21',
        ]);

        DB::table('items')->insert([
            'user_id' => '0',
            'name' => '豚肩ロース',
            'status' => 'negative',
            'category_id' => '0',
            'detail' => "",
            'created_at' => '2023-02-22',
            'updated_at' => '2023-02-22',
        ]);

        DB::table('items')->insert([
            'user_id' => '0',
            'name' => 'りんご',
            'status' => 'active',
            'category_id' => '0',
            'detail' => "リンゴ酸やクエン酸など、豊富な有機酸が疲労回復を促進する。\n豊富な水溶性食物繊維のペクチンには、整腸作用、コレステロールの吸収抑制効果が期待でき、抗酸化作用や脂肪低減作用、老化防止効果の期待できるポリフェノールも豊富。",
            'created_at' => '2023-02-23',
            'updated_at' => '2023-02-23',
        ]);

        
    }
}
