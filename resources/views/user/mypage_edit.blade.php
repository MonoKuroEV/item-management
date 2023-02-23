@extends('adminlte::page')

@section('title', 'マイページ編集')

@section('content_header')
    <h1>マイページ編集</h1>
@stop

@section('content')

{{-- フラッシュメッセージ --}}
@if(session('add_message'))
    <div class="alert alert-success text-center">
        {{ session('add_message') }}
    </div>
@endif

@if($errors->any())
    <p class="alert-danger rounded mt-1 p-2">変更内容の登録に失敗しました。入力内容を確認してください。</p>
@endif

<div class="row">
    <div class="col-md-12">

        {{-- 名前変更 --}}
        <form method="POST" action="{{ url('users/mypage_edit')}}" onsubmit="return confirm('名前を変更します。よろしいですか？')">
            @csrf
            {{-- 送信方式 --}}
            @method('PUT')
            <div class="card mb-3">
                <div class="card-header"><label for="name">名前</label></div>
                <div class="card-body">
                    <div class="form-group">
                        <p>現在：{{$user->name}}</p>
                        <div class="input-group">
                            <input type="hidden" name="type" value="name" >
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" placeholder="新しい名前を入力">
                            <span class="input-group-btn">
                                <button type="submit" class="btn btn-primary">変更</button>
                            </span>
                        </div>
                        @if ($errors->has('name'))
                            <p class="alert-danger rounded mt-1 p-2">{{ $errors->first('name')}}</p>
                        @endif
                    </div>
                </div>
            </div>
        </form>

        {{-- メールアドレス変更 --}}
        <form method="POST" onsubmit="return confirm('メールアドレスを変更します。よろしいですか？')">
            @csrf
            {{-- 送信方式 --}}
            @method('PUT')
            <div class="card mb-3">
                <div class="card-header"><label for="email">メールアドレス</label></div>
                <div class="card-body">
                    <div class="form-group">
                        <p>現在：{{$user->email}}</p>
                        <div class="input-group">
                            <input type="hidden" name="type" value="email" >
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="新しいメールアドレスを入力">
                            <span class="input-group-btn">
                                <button type="submit" class="btn btn-primary">変更</button>
                            </span>
                        </div>
                        @if ($errors->has('email'))
                            <p class="alert-danger rounded mt-1 p-2">{{ $errors->first('email')}}</p>
                        @endif
                    </div>
                </div>
            </div>
        </form>



        <form method="POST" onsubmit="return confirm('パスワードを変更します。よろしいですか？')">
            @csrf
            {{-- 送信方式 --}}
            @method('PUT')

            <div class="card mb-3">
                <div class="card-header"><label>パスワード</label></div>
                <div class="card-body">

                    <div class="form-group">
                        <p>現在：セキュリテー保護のため表示していません。</p>
                        <input type="hidden" name="type" value="password" >
                        <div style="margin-bottom:20px">
                            <label for="password_old">変更前のパスワード</label>
                            <input type="password" class="form-control" id="password_old" name="password_old"  placeholder="変更前のパスワードを入力">
                            @if ($errors->has('password_old'))
                                <p class="alert-danger rounded mt-1 p-2">{{ $errors->first('password_old')}}</p>
                            @endif
                            @if ($errors->has('Auth'))
                                <p class="alert-danger rounded mt-1 p-2">{{ $errors->first('Auth')}}</p>
                            @endif
                        </div>

                        <div>
                            <label for="password">新しいパスワード</label>
                            <input type="password" class="form-control" id="password" name="password"  placeholder="新しいパスワードを入力">
                            @if ($errors->has('password'))
                                <p class="alert-danger rounded mt-1 p-2">{{ $errors->first('password')}}</p>
                            @endif

                            <label for="password_confirmation">[確認]パスワード</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"  placeholder="[確認]パスワードを入力">
                        </div>

                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary mb-4 w-25">変更</button>
                </div>
            </div>

        </form>

        <div class="d-flex justify-content-center">
            <a href="{{ url('users/mypage')}}"  class="btn btn-secondary mb-3 w-25" >戻る</a>
        </div>
    </div>
</div>






@stop

@section('css')
@stop

@section('js')
@stop
