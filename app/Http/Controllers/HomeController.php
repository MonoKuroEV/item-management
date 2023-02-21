<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Item;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    // public function index()
    // {
    //     return view('home');
    // }

        /**
     * 商品一覧//
     */
    public function index()
    {
        // 最近登録された商品一覧取得
        $items = Item
        ::where('items.status', 'active')
        ->orderBy('items.created_at','DESC')
        ->select('items.id','items.name','items.created_at','items.updated_at','categories.name as categories_name')
        ->leftJoin('categories', 'items.category_id', '=', 'categories.id') 
        ->limit(8)
        ->get();

        $categories = Category::
        select('categories.id','categories.name')
        ->get();

        return view('home', compact('items','categories'));
    }
}
