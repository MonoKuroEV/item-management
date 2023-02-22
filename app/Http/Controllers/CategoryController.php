<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log; //デバックログクラス
use Illuminate\Http\Request;
use App\Models\Category;

use App\Models\Item;
use Laravel\Ui\Presets\React;

class CategoryController extends Controller
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
     * カテゴリー一覧//
     */
    public function category(Request $request)
    {
        // カテゴリー追加
        if ($request->isMethod('post')  && $request->type === 'add') {

            // バリデーション
            $this->validate($request, [
                'name' => ['required','string','max:100', 'unique:categories'],
            ],[
                'name.required' => 'カテゴリー名を入力してください。',
                'name.string' => 'カテゴリー名は文字列を指定してください。',
                'name.max' => 'カテゴリー名は、 100 文字以内にする必要があります。',
                'name.unique' => '指定のカテゴリー名は、既に使用されています。',
            ]);

            // カテゴリー登録
            Category::create([
                'name' => $request->name,
            ]);

            //カテゴリー一覧画面に遷移
            return redirect('categories/')->with('add_message', 'カテゴリーを登録しました。');
        }

        // カテゴリー検索
        if ($request->isMethod('post') && $request->type === 'search'){

            $keyword = $request->keyword;

        $categories = Category::
        where('categories.name','like',"%$request->keyword%")
        ->orderBy('categories.id','DESC')
        ->select('categories.id','categories.name')
        ->get();

        // Log::debug($categories);

        return view('category.index', compact('categories','keyword'));
        }


        // カテゴリー削除更新処理
        if ($request->isMethod('put') && $request->type === 'delete') {

            $category = Category::find($request->id);


            $items = Item::where('items.category_id',$request->id)->get();

            $category_name = Category::
            where('categories.name','no-category')->get();

            Log::debug($category_name[0]["name"]);
    
            foreach($items as $item){
    
                $item->category_id = $category_name[0]["id"];
                // データを更新
                $item->save();
            }
    
            $category->delete();
    
           // 商品一覧画面に遷移
            return redirect('categories/')->with('delete_message', 'カテゴリーを削除しました。');
        }

        // カテゴリー一覧取得
        $categories = Category::
        select('categories.id','categories.name')
        ->orderBy('categories.id','DESC')
        ->get();
        
        // Log::debug($categories);

        return view('category.index',compact('categories'));

    }


    /**
     * カテゴリー編集//
     */
    public function edit(Request $request, $id){

        // PUTリクエストのとき
        if ($request->isMethod('put')) {

            // バリデーション
            $this->validate($request, [
                'name' => ['required','string','max:100', 'unique:categories'],
            ],[
                'name.required' => 'カテゴリー名を入力してください。',
                'name.string' => 'カテゴリー名は文字列を指定してください。',
                'name.max' => 'カテゴリー名は、 100 文字以内にする必要があります。',
                'name.unique' => '指定のカテゴリー名は、既に使用されています。',
            ]);

            $category=Category::find($id);

            // Log::debug($request->name);

            // 更新データをセット
            $category->name = $request->name;

            // データを更新
            $category->save();

            return redirect('categories/')->with('add_message', '編集内容を登録しました。');

        }
        
        // 商品編集画面に遷移
        $category=Category::
        select('categories.id','categories.name')
        ->find($id);

        return view('category.edit',compact('category'));

    }

}
