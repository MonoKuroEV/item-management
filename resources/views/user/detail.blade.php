@extends('adminlte::page')

@section('title', 'アカウント詳細')

@section('content_header')
    <h1>アカウント詳細</h1>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">

        <div class="card mb-3">
            <div class="card-header">名前</div>
            <div class="card-body">
                <h4 class="card-title" style="width:100%">{{ $user->name }}</h4>
            </div>
        </div>

        <div class="card mb-3" >
            <div class="card-header">メールアドレス</div>
            <div class="card-body">
                <h4 class="card-title">{{ $user->email }}</h4>
            </div>
        </div>

        <div class="card mb-3" >
            <div class="card-header">権限</div>
            <div class="card-body">
                
                @if( $user->role === 0)
                <h4 class="card-title" style="width:100%; white-space:pre-wrap">一般</h4>
                @elseif( $user->role === 1)
                <h4 class="card-title" style="width:100%; white-space:pre-wrap">管理者</h4>
                @endif
            </div>
        </div>

        <div class="card mb-3" >
            <div class="card-header">登録日時</div>
            <div class="card-body">
                <h4 class="card-title">{{ $user->created_at }}</h4>
            </div>
        </div>

        <div class="card mb-3" >
            <div class="card-header">更新日時</div>
            <div class="card-body">
                <h4 class="card-title">{{ $user->updated_at }}</h4>
            </div>
        </div>
        
        <div class="d-flex justify-content-center">
            <a href="{{ url('users/edit', ['id' => $user->id]) }}" class="btn btn-primary mb-3 mr-3 w-25" >権限変更</a>
            <a href="{{ url('/users')}}"  class="btn btn-secondary mb-3 w-25" >戻る</a>
        </div>
    </div>
</div>
@stop

@section('css')
@stop

@section('js')
@stop

