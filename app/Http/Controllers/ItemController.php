<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Item;

use Illuminate\Support\Facades\Log; //デバックログクラス

class ItemController extends Controller
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
     * 商品一覧//
     */
    public function index(Request $request)
    {

        /**
         * 商品検索処理//
         */
        if($request->isMethod('post') && $request->type === 'search'){

            if($request->orderby === 'desc'){
                $orderby_set = 'DESC';
            }else{
                $orderby_set = 'ASC';
            }
    
            $categories = Category::
            select('categories.id','categories.name')
            ->get();
    
            $keyword = $request->keyword;
            $created_at = $request->created_at;
            $orderby = $request->orderby;
            $show = 'show';
    
            $category_id = $request->category_id;
            $status = $request->status;
        
            $items = Item::where('items.name','like',"%$request->keyword%")
            ->where('items.status', 'active')
            ->Where('items.created_at','like',"$request->created_at%")

            ->when($category_id, function ($query,$category_id){
                return $query->Where('items.category_id','=',$category_id);
            })

            ->orderBy('items.created_at',$orderby_set)
            ->select('items.id','items.name','items.created_at','categories.name as categories_name')
            ->leftJoin('categories', 'items.category_id', '=', 'categories.id') 
            ->get();

            return view('item.index', compact('items','keyword','created_at','orderby','show','category_id','categories'));
        }

        // 商品一覧取得
        $items = Item
        ::where('items.status', 'active')
        ->orderBy('items.created_at','DESC')
        ->select('items.id','items.name','items.created_at','categories.name as categories_name','categories.id as categories_id')
        ->leftJoin('categories', 'items.category_id', '=', 'categories.id') 
        ->get();

        $categories = Category::get();

        return view('item.index', compact('items','categories'));
    }

    /**
     * 商品管理//
     */
    public function management(Request $request)
    {

        /**
         * 商品検索処理//
         */
        if($request->isMethod('post') && $request->type === 'search'){

            if($request->orderby === 'desc'){
                $orderby_set = 'DESC';
            }else{
                $orderby_set = 'ASC';
            }
    
            $categories = Category::
            select('categories.id','categories.name')
            ->get();
    
            $keyword = $request->keyword;
            $created_at = $request->created_at;
            $orderby = $request->orderby;
            $show = 'show';
    
            $category_id = $request->category_id;
            $status = $request->status;

            $items = Item::where('items.name','like',"%$request->keyword%")
            ->Where('items.created_at','like',"$request->created_at%")

            ->when($category_id, function ($query,$category_id){
                return $query->Where('items.category_id','=',$category_id);
            })
            ->when($status, function ($query,$status){
                return $query->Where('items.status','=',$status);
            })
            
            ->orderBy('items.created_at',$orderby_set)
            ->select('items.id','items.name','items.status','items.created_at','categories.name as categories_name')
            ->leftJoin('categories', 'items.category_id', '=', 'categories.id') 
            ->get();
            return view('item.management', compact('items','keyword','created_at','orderby','show','category_id','categories','status'));
        }


        /**
         * 商品削除//
         */
        if($request->isMethod('post') && $request->type === 'delete'){
                    
        $item = Item::find($request->id);
        //商品を削除
        $item->delete();

        // 商品一覧画面に遷移
        return redirect('items/management')->with('delete_message', '商品を削除しました。');

        }


        // 商品一覧取得
        $items = Item::orderBy('items.created_at','DESC')
        ->select('items.id','items.name','items.status','items.created_at','categories.name as categories_name')
        ->leftJoin('categories', 'items.category_id', '=', 'categories.id')  // 第一引数に結合するテーブル名、第二引数に主テーブルの結合キー、第四引数に結合するテーブルの結合キーを記述
        ->get();

        $categories = Category::get();

        return view('item.management', compact('items','categories'));
    }

    /**
     * 商品登録//
     */
    public function add(Request $request)
    {
        // POSTリクエストのとき
        if ($request->isMethod('post')) {
            // バリデーション
            $this->validate($request, [
                'name' => 'required|max:100',
            ],[
                'name.max' => '商品名は、100文字以下にしてください。',
                'name.required' => '商品名を入力してください。'
            ]);

            // 商品登録
            Item::create([
                'user_id' => Auth::user()->id,
                'name' => $request->name,
                'category_id' =>$request->category_id,
                'status' => $request->status,
                'detail' => $request->detail,
            ]);

            //商品一覧画面に遷移
            return redirect('items/management')->with('add_message', '商品を登録しました。');
        }

        // カテゴリーデータ取得
        $categories = Category::get();

        // 商品追加画面に遷移
        return view('item.add',compact('categories'));
    }


    /**
     * 商品詳細//
     */
    public function detail($id,$role)
    {

        $role_id = $role;

        $item=Item::
        select('items.id','items.name','items.detail','items.created_at','items.updated_at','items.status','categories.name as categories_name')
        ->leftJoin('categories', 'items.category_id', '=', 'categories.id')
        ->find($id);

        // Log::debug($item);

        
        return view('item.detail',compact('item','role_id'));
    }


    /**
     * 商品編集//
     */
    public function edit(Request $request, $id)
    {
        // putリクエストのとき
        if ($request->isMethod('put')) {

            // バリデーション
            $this->validate($request, [
                'name' => 'required|max:100',
            ],[
                'name.required' => '商品名を入力してください。',
                'name.max' => '商品名は100文字以内にする必要があります。' 
            ]);

            $item=Item::find($id);

            // 更新データをセット
            $item->name = $request->name;
            $item->status = $request->status;
            $item->detail = $request->detail;
            $item->category_id = $request->category_id;

            // データを更新
            $item->save();

            // 商品一覧画面に遷移
            return redirect('items/management')->with('add_message', '編集内容を登録しました。');
        }


        $item = Item::
        select('items.id','items.name','items.detail','items.status','categories.id as categories_id')
        ->leftJoin('categories', 'items.category_id', '=', 'categories.id') 
        ->find($id);

        Log::debug($item);

        $categories = Category::
        select('categories.id','categories.name')
        ->get();

        return view('item.edit',compact('item','categories'));
    }

}
