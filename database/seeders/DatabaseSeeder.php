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

        // カテゴリー
        DB::table('categories')->insert([
            'name' => 'no-category',
        ]);

        // masterアカウント
        DB::table('users')->insert([
            'name' => 'master1',
            'email' => 'master@1',
            'password' => Hash::make('12345678'),
            'role' => '2',
        ]);

        DB::table('users')->insert([
            'name' => 'master2',
            'email' => 'master@2',
            'password' => Hash::make('12345678'),
            'role' => '2',
        ]);

        DB::table('users')->insert([
            'name' => 'master3',
            'email' => 'master@3',
            'password' => Hash::make('12345678'),
            'role' => '2',
        ]);



    }
}
