@extends('adminlte::page')

@section('title', 'マイページ')

@section('content_header')
    <h1>マイページ</h1>
@stop


@section('content')



<div class="row">
    <div class="col-md-12">

        <div class="card mb-3" >
            <div class="card-header">権限</div>
            <div class="card-body">
                @if( $user->role === 0)
                <h4 class="card-title">一般</h4>
                @elseif( $user->role === 1)
                <h4 class="card-title">管理者</h4>
                @elseif( $user->role === 2)
                <h4 class="card-title">マスター</h4>
                @endif
            </div>
        </div>

        <div class="card mb-3" >
            <div class="card-header">名前</div>
            <div class="card-body">
                <h4 class="card-title">{{ $user->name }}</h4>
            </div>
        </div>

        <div class="card mb-3" >
            <div class="card-header">メールアドレス</div>
            <div class="card-body">
                <h4 class="card-title">{{ $user->email }}</h4>
            </div>
        </div>

        <div class="card mb-3" >
            <div class="card-header">パスワード</div>
            <div class="card-body">
                <h4 class="card-title">セキュリテー保護のため表示していません。</h4>
            </div>
        </div>

        {{-- マイページ編集 --}}
        <div class="d-flex justify-content-center">
            <a href="{{ url('users/mypage_edit')}}"  class="btn btn-primary mb-3 w-25" >編集</a>
        </div>
        
    </div>


</div>
@stop

@section('css')
@stop

@section('js')
@stop

