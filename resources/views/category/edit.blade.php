@extends('adminlte::page')

@section('title', '商品編集')

@section('content_header')
    <h1>カテゴリー編集</h1>
@stop

@section('content')

@if($errors->any())
    <p class="alert-danger rounded mt-1 p-2">登録に失敗しました。入力内容を確認してください。</p>
@endif

<div class="row">
    <div class="col-md-12">

        <form method="POST" action="{{  url('categories/edit', ['id' => $category->id]) }}" onsubmit="return confirm('編集内容を登録します。よろしいですか？')">
            @csrf
            {{-- 送信方式 --}}
            @method('PUT')

            <div class="card mb-3">
                <div class="card-header"><label for="name">カテゴリー名</label></div>
                <div class="card-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $category->name)}}">
                        @if ($errors->has('name'))
                            <p class="alert-danger rounded mt-1 p-2">{{ $errors->first('name')}}</p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary mb-3 mr-3 w-25">登録</button>
                <a href="{{ url('categories') }}" class="btn btn-secondary mb-3 mr-3 w-25">戻る</a>
            </div>
        </form>
        
    </div>
</div>

@stop

@section('css')
@stop

@section('js')
@stop
