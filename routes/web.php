<?php

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();


    Route::get('/', [App\Http\Controllers\ItemController::class, 'index'])->name('home');

    //カテゴリー関係
    Route::prefix('categories')->group(function () {

        // 管理者のみ
        Route::group(['middleware' => ['auth', 'can:admin']], function(){
            
            // カテゴリー
            Route::get('/',[App\Http\Controllers\CategoryController::class, 'category']); //カテゴリー管理画面表示
            Route::post('/',[App\Http\Controllers\CategoryController::class, 'category']); //カテゴリー追加、検索処理
            Route::put('/',[App\Http\Controllers\CategoryController::class, 'category']); //カテゴリー削除更新処理

            Route::get('/edit/{id}',[App\Http\Controllers\CategoryController::class, 'edit']); //カテゴリー編集画面表示
            Route::put('/edit/{id}',[App\Http\Controllers\CategoryController::class, 'edit']); //カテゴリー編集画面表示
            
            });
    });


    //商品関係
    Route::prefix('items')->group(function () {

        Route::get('/', [App\Http\Controllers\ItemController::class, 'index']);     //商品一覧画面表示
        Route::post('/', [App\Http\Controllers\ItemController::class, 'index']);     //商品検索処理

        Route::get('/detail/{id}/{role}',[App\Http\Controllers\ItemController::class, 'detail']); //商品詳細画面表示
        
        // 管理者のみ
        Route::group(['middleware' => ['auth', 'can:admin']], function(){

            // 商品関連
            Route::get('/management', [App\Http\Controllers\ItemController::class, 'management']);   //商品管理画面表示
            Route::post('/management', [App\Http\Controllers\ItemController::class, 'management']);   //商品管理検索、削除処理
            

            Route::get('/add', [App\Http\Controllers\ItemController::class, 'add']);    //商品登録画面表示
            Route::post('/add', [App\Http\Controllers\ItemController::class, 'add']);   //商品登録処理

            Route::get('/edit/{id}', [App\Http\Controllers\ItemController::class, 'edit']);   //商品編集画面表示
            Route::put('/edit/{id}', [App\Http\Controllers\ItemController::class, 'edit']);   //商品更新処理
        });
    });

    // アカウント関係
    Route::prefix('users')->group(function () {

        Route::get('/mypage', [App\Http\Controllers\AccountController::class, 'mypage']); //マイページ表示
        Route::get('/mypage_edit', [App\Http\Controllers\AccountController::class, 'mypage_edit']); //マイページ編集画面表示
        Route::put('/mypage_edit', [App\Http\Controllers\AccountController::class, 'mypage_edit']); //マイページ編集処理
        
        
        // 管理者のみ
        Route::group(['middleware' => ['auth', 'can:admin']], function(){

            Route::post('/search',[App\Http\Controllers\AccountController::class, 'search']);  //アカウント検索
            Route::get('/', [App\Http\Controllers\AccountController::class, 'index']);  //アカウント一覧
            Route::post('/delete', [App\Http\Controllers\AccountController::class, 'delete']);   //アカウント削除処理
            Route::get('/detail/{id}', [App\Http\Controllers\AccountController::class, 'detail']); //アカウント詳細画面表示
            Route::get('/edit/{id}', [App\Http\Controllers\AccountController::class, 'edit']); //アカウント編集画面表示
            Route::put('/edit/{id}', [App\Http\Controllers\AccountController::class, 'edit']); //アカウント編集処理
        });

        Route::group(['middleware' => ['auth', 'can:master']], function(){

            Route::post('/delete', [App\Http\Controllers\AccountController::class, 'delete']);   //アカウント削除処理
            Route::get('/edit/{id}', [App\Http\Controllers\AccountController::class, 'edit']); //アカウント権限編集画面表示
            Route::put('/edit/{id}', [App\Http\Controllers\AccountController::class, 'edit']); //アカウント権限編集処理
        });

    });