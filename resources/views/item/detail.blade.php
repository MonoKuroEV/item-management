@extends('adminlte::page')

@section('title', '商品詳細')

@section('content_header')
    <h1>商品詳細</h1>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">

        <div class="card mb-3">
            <div class="card-header">商品名</div>
            <div class="card-body">
                <h4 class="card-title" style="width:100%">{{ $item->name }}</h4>
            </div>
        </div>

        <div class="card mb-3" >
            <div class="card-header">カテゴリー</div>
            <div class="card-body">
                <h4 class="card-title">{{ $item->categories_name }}</h4>
            </div>
        </div>

        <div class="card mb-3" >
            <div class="card-header">詳細</div>
            <div class="card-body">
                <h4 class="card-title" style="width:100%; white-space:pre-wrap">{{ $item->detail }}</h4>
            </div>
        </div>

        <div class="card mb-3" >
            <div class="card-header">登録日時</div>
            <div class="card-body">
                <h4 class="card-title" style="width:100%; white-space:pre-wrap">{{ $item->created_at }}</h4>
            </div>
        </div>

        <div class="card mb-3" >
            <div class="card-header">更新日時</div>
            <div class="card-body">
                <h4 class="card-title" style="width:100%; white-space:pre-wrap">{{ $item->updated_at }}</h4>
            </div>
        </div>

        @if($role_id === '1')
        <div class="card mb-3" >
            <div class="card-header">ステータス</div>
            <div class="card-body">
                @if($item->status === 'negative')
                    <h4 class="card-title" style="width:100%; white-space:pre-wrap">非公開</h4>
                @elseif($item->status === 'active')
                    <h4 class="card-title" style="width:100%; white-space:pre-wrap">公開</h4>
                @endif
            </div>
        </div>
        @endif

        <div class="d-flex justify-content-center">

            @if($role_id === '1')
                <a href="{{ url('items/edit', ['id' => $item->id]) }}" class="btn btn-primary mb-3 mr-3 w-25">編集</a>
            @endif

            <button  class="btn btn-secondary mb-3 w-25" type="button" onclick="history.back()">戻る</button>
        </div>
        
    </div>
</div>
@stop

@section('css')
@stop

@section('js')
@stop

