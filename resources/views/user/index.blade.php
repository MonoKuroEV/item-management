@extends('adminlte::page')

@section('title', 'アカウント管理')

@section('content_header')
<div class="d-flex justify-content-between">
    <h1>アカウント管理</h1>
    <a class="btn btn-primary m-1" data-toggle="collapse" href="#collapseExample">  
        <i class="fa fa-search"></i> 
    </a>
</div>
@stop

@section('content')

{{-- フラッシュメッセージ --}}
@if(session('add_message'))
    <div class="alert alert-success text-center">
        {{ session('add_message') }}
    </div>
@endif

{{-- フラッシュメッセージ --}}
@if(session('delete_message'))
<div class="alert alert-danger text-center">
    {{ session('delete_message') }}
</div>
@endif

<div class="row">
    <div class="col-12">

        <div class="collapse
        @if(isset($show) && $show === 'show')
        show
        @endif
        " id="collapseExample">
        
            <form method="POST" action="{{ url('users/search')}}" onsubmit="return">
                @csrf

                <div class="card p-2">

                    <div class="form-group row">
                        <label class="col-form-label col-sm-2" for="keyword">検索キーワード:</label>
                        <div class="col-sm-10">
                            <input type="search" class="form-control" id="keyword" name="keyword" placeholder="検索キーワードを入力"
                            @if(isset($keyword))
                                value="{{ $keyword }}"
                            @endif>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-sm-2" for="created_at">登録日:</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="date" name="created_at" id="created_at"
                            @if(isset($created_at))
                                value="{{ $created_at }}"
                            @endif>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-sm-2" for="role">権限:</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="role" id="role">
        
                                <option value= "all"
                                @if (!isset($role) || $role === 'all')
                                    selected
                                @endif
                                >
                                全て
                                </option>
        
                                <option value= "general"
                                    @if (isset($role) && $role === 'general')
                                        selected
                                    @endif
                                    >
                                    一般
                                </option>
        
                                <option value="admin"
                                    @if (isset($role) && $role === 'admin')
                                        selected
                                    @endif
                                    >
                                    管理者
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-sm-2" for="orderby">並び替え:</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="orderby" id="orderby">
                                
                                <option value="desc"
                                    @if (!isset($orderby) || $orderby === 'desc')
                                        selected
                                    @endif>
                                    新しい順
                                </option>
        
                                <option value="asc"
                                    @if (isset($orderby) && $orderby === 'asc')
                                        selected
                                    @endif>
                                    古い順
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary m-1">検索</button>
                        <a href="{{ url('/users')}}" class="btn btn-primary m-1">リセット</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


        <div class="card">
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap table-striped">
                    <thead>
                        <tr>
                            <th>名前</th>
                            <th>権限</th>
                            <th>メールアドレス</th>
                            <th>登録日時</th>
                            <th>操作</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)

                        {{-- マスターアカウント、ログインユーザーのアカウントを非表示  --}}
                        @if( !($user->role === 2 || $id === $user->id)) 
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>
                                    @if( $user->role === 0)
                                    一般
                                    @elseif( $user->role === 1)
                                    管理者
                                    @endif
                                </td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->created_at }}</td>

                                <td class="d-flex">

                                    <div style="margin-right: 5px">
                                        {{-- アカウント詳細 --}}
                                        <a href="{{ url('users/detail', ['id' => $user->id]) }}" class="btn btn-default">詳細</a>
                                    </div>

                                    @if($role === 2)
                                    <div style="margin-right: 5px">
                                        {{-- アカウント権限編集 --}}
                                        <a href="{{ url('users/edit', ['id' => $user->id]) }}" class="btn btn-default">権限変更</a>
                                    </div>
                                    
                                    <div>
                                        {{-- アカウント削除 --}}
                                        <form action="{{ url('users/delete') }}" method="POST" onsubmit="return confirm('「{{$user->name}}」を削除します。よろしいですか？')">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $user->id }}">
                                            <input type="submit" value="削除" class="btn btn-danger">
                                        </form>
                                    </div>
                                    @endif
                                    
                                </td>
                                
                            </tr>
                        @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>


@stop

@section('css')
@stop

@section('js')
@stop