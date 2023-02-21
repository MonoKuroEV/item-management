@extends('adminlte::page')

@section('title', 'アカウント権限変更')

@section('content_header')
    <h1>アカウント権限変更</h1>
@stop

@section('content')



@if($errors->any())
    <p class="alert-danger rounded mt-1 p-2">登録に失敗しました。入力内容を確認してください。</p>
@endif

<div class="row">
    <div class="col-md-12">

        <div class="card mb-3">
            <div class="card-header">名前</div>
            <div class="card-body">
                <h4 class="card-title" style="width:100%">{{ $user->name }}</h4>
            </div>
        </div>
        
        <form method="POST" action="{{ url('users/edit', ['id' => $user->id]) }}" onsubmit="return confirm('権限を変更します。よろしいですか？')">
            @csrf
            {{-- 送信方式 --}}
            @method('PUT')
            <div class="card mb-3">
                <div class="card-header"><label>権限</label></div>
                <div class="card-body">
                    <div class="form-group">

                            <select class="form-control" name="role" id="role">
        
                                <option value= "0"
                                    @if ($user->role === 0)
                                        selected
                                    @endif
                                    >
                                    一般
                                </option>
        
                                <option value="1"
                                    @if ($user->role === 1)
                                        selected
                                    @endif
                                    >
                                    管理者
                                </option>
                            </select>

                            <span class="input-group-btn">
                            </span>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary mb-3 mr-3 w-25">登録</button>
                <a href="{{ url('/users')}}"  class="btn btn-secondary mb-3 w-25" >戻る</a>
            </div>
        </form>

    </div>
</div>
@stop

@section('css')
@stop

@section('js')
@stop
