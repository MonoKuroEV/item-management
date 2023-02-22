<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

use Illuminate\Support\Facades\Hash; //ハッシュ化

use Illuminate\Support\Facades\Log; //デバックログクラス

class AccountController extends Controller
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
     * マイページ表示//
     */
    public function mypage(){

        $auth_id = Auth::id();
        $user=User::
        select('users.id','users.name','users.role','users.email')
        ->find($auth_id);

        // Log::debug($user);
        return view('user.mypage', compact('user'));
    }

    /**
     * マイページ編集画面表示//
     */
    public function mypage_edit(Request $request){
        
        // putリクエストのとき
        if($request->isMethod('put')) {
            
            $auth_id = Auth::id();
            $user=User::find($auth_id);

            //名前が入力された時のバリデーション
            if(isset($request->name)){
                $this->validate($request, [
                    'name' => ['string','max:255'],
                ],[
                    'name.string' => '名前は文字列を指定してください。',
                    'name.max' => '名前は255文字以内にする必要があります。' 
                ]);

                // 更新データの値をセット
                $user->name = $request->name;

                // データを更新
                $user->save();
                return back()->with('add_message', '新しい名前を登録しました。');

            };

            // メールアドレスが入力された時のバリデーション
            if(isset($request->email)){
                $this->validate($request, [
                    'email' => ['string', 'email', 'max:255', 'unique:users'],
                ],[
                    'email.string' => 'メールアドレスは文字列を指定してください。',
                    'email.email' => '有効なメールアドレス形式で指定してください。',
                    'email.max' => 'メールアドレスは、 255 文字以内にする必要があります。',
                    'email.unique' => '指定のメールアドレスは、既に使用されています。',
                ]);

                // 更新データの値をセット
                $user->email = $request->email;

                // データを更新
                $user->save();
                return back()->with('add_message', '新しいメールアドレスを登録しました。');

            };


            // パスワードが入力された時のバリデーション
            if(isset($request->password_old) || isset($request->password)){

                // 現在のパスワードのバリデーションチェック
                $validate = $request->validate([
                    'password_old' => ['required'],
                ],[
                    'password_old.required' => '現在のパスワードを入力してください。',
                ]);

                // 現在のパスワードチェック
                if(Hash::check($request->password_old,$user->password)){

                    // 新しいパスワードのバリデーションチェック
                    $validate = $request->validate([
                        'password' =>  ['required', 'string','max:128', 'min:8', 'confirmed'],
                    ],[
                        'password.required' => '新しいパスワードを入力してください。',
                        'password.max' => 'パスワードは、 128 文字以内にする必要があります。',
                        'password.confirmed' => '確認パスワードと入力内容が一致しません。',
                        'password.min' => 'パスワードは8文字以上にする必要があります。',
                    ]);

                    // 更新データの値をセット
                    $user->password = Hash::make($request->password);

                    // データを更新
                    $user->save();
                    return back()->with('add_message', '新しいパスワードを登録しました。');
                    
                }else{
                    return back()->withErrors([
                        'Auth' => 'パスワードが違います。',
                    ]);
                }
            }
        }

        $auth_id = Auth::id();
        $user=User::
        select('users.id','users.name','users.email')
        ->find($auth_id);

        // Log::debug($user);

        return view('user.mypage_edit', compact('user'));
    }


    
    /**
     * アカウント検索//
     */
    public function search(Request $request)
    {
        if($request->orderby === 'desc'){
            $orderby_set = 'DESC';
        }else{
            $orderby_set = 'ASC';
        }

        if($request->role === 'general' || $request->role === 'admin'){
            
            if($request->role === 'general'){
                $role_set = 0;
            }elseif($request->role === 'admin'){
                $role_set = 1;
            }

            $users = User::where('users.name','like',"%$request->keyword%")
            ->Where('users.created_at','like',"$request->created_at%")
            ->Where('users.role','=',$role_set)
            ->orderBy('users.created_at',$orderby_set)
            ->select('users.id','users.name','users.role','users.email','users.created_at')
            ->get();

        }else{
            $users = User::where('users.name','like',"%$request->keyword%")
            ->Where('users.created_at','like',"$request->created_at%")
            ->orderBy('users.created_at',$orderby_set)
            ->select('users.id','users.name','users.role','users.email','users.created_at')
            ->get();
            
        }
        
        $id= Auth::id();
        $keyword = $request->keyword;
        $orderby = $request->orderby;
        $created_at = $request->created_at;
        $role = $request->role;
        $show = 'show';

        return view('user.index', compact('users','id','keyword','orderby','created_at','role','show'));
    }


    /**
     * アカウント一覧//
     */
    public function index()
    {

        $users = User::orderBy('users.created_at','DESC')
        ->select('users.id','users.name','users.role','users.email','users.created_at')
        ->get();

        //自分のユーザIDを取得
        $id= Auth::id();
        $role = Auth::user()->role;
        // Log::debug($role);
        return view('user.index', compact('users','id','role'));
    }

    /**
     * アカウント削除//
     */
    public function delete(Request $request)
    {
        $user = User::find($request->id);
        // Log::debug($user);

        //商品を削除
        $user->delete();

        // アカウント管理画面に遷移
        return redirect('/users')->with('delete_message', 'アカウントを削除しました。');
    }

    /**
     * アカウント詳細//
     */
    public function detail(Request $request, $id)
    {
        $user = User::
        select('users.id','users.name','users.role','users.email','users.created_at','users.updated_at')
        ->find($id);

        // Log::debug($user);

        return view('user.detail', compact('user'));
    }


    /**
     * アカウント権限更新//
     */
    public function edit(Request $request, $id)
    {
        // putリクエストのとき
        if($request->isMethod('put')) {

            $user = User::find($id);

            // Log::debug($user);

            $user->role = $request->role;

            // データを更新
            $user->save();

            return redirect('/users')->with('add_message', '権限を変更しました。');
        }

        $user = User::
        select('users.id','users.name','users.role')
        ->find($id);

        // Log::debug($user);

        //ログイン中のユーザのIDを取得
        $auth_id = Auth::id();
        $auth_user=User::find($auth_id);

        return view('user.edit', compact('user','auth_user'));
    }
}
