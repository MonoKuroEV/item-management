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
            'email' => 'master1@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => '2',
            'created_at' => '2023-02-17',
            'updated_at' => '2023-02-17',
        ]);
        
        DB::table('users')->insert([
            'name' => 'master2',
            'email' => 'master2@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => '2',
            'created_at' => '2023-02-18',
            'updated_at' => '2023-02-18',
        ]);
        
        DB::table('users')->insert([
            'name' => 'master3',
            'email' => 'master3@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => '2',
            'created_at' => '2023-02-19',
            'updated_at' => '2023-02-19',
        ]);

        DB::table('users')->insert([
            'name' => 'admin1',
            'email' => 'admin1@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => '1',
            'created_at' => '2023-02-20',
            'updated_at' => '2023-02-20',
        ]);

        DB::table('users')->insert([
            'name' => 'admin2',
            'email' => 'admin2@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => '1',
            'created_at' => '2023-02-21',
            'updated_at' => '2023-02-21',
        ]);

        DB::table('users')->insert([
            'name' => 'admin3',
            'email' => 'admin3@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => '1',
            'created_at' => '2023-02-22',
            'updated_at' => '2023-02-22',
        ]);

        DB::table('users')->insert([
            'name' => 'test1',
            'email' => 'test1@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => '0',
            'created_at' => '2023-02-23',
            'updated_at' => '2023-02-23',
        ]);

        DB::table('users')->insert([
            'name' => 'test2',
            'email' => 'test2@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => '0',
            'created_at' => '2023-02-24',
            'updated_at' => '2023-02-24',
        ]);

        DB::table('users')->insert([
            'name' => 'test3',
            'email' => 'test3@gmail.com',
            'password' => Hash::make('12345678'),
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
            'name' => 'りんご',
            'status' => 'active',
            'category_id' => '0',
            'detail' => "りんごです。\nりんごです。",
            'created_at' => '2023-02-17',
            'updated_at' => '2023-02-17',
        ]);

        
    }
}
