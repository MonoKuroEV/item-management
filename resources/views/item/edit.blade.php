@extends('adminlte::page')

@section('title', '商品編集')

@section('content_header')
    <h1>商品編集</h1>
@stop

@section('content')

@if($errors->any())
    <p class="alert-danger rounded mt-1 p-2">登録に失敗しました。入力内容を確認してください。</p>
@endif

<div class="row">
    <div class="col-md-12">

        <form method="POST" action="{{ url('items/edit', ['id' => $item->id]) }}" onsubmit="return confirm('編集内容を登録します。よろしいですか？')">
            @csrf
            {{-- 送信方式 --}}
            @method('PUT')


            <div class="card mb-3">
                <div class="card-header"><label for="name">商品名</label></div>
                <div class="card-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $item->name)}}">
                        @if ($errors->has('name'))
                            <p class="alert-danger rounded mt-1 p-2">{{ $errors->first('name')}}</p>
                        @endif
                    </div>
                </div>
            </div>

            <div class="card mb-3">
                <div class="card-header"><label for="category_id">カテゴリー</label></div>
                <div class="card-body">
                    <div class="form-group">
                        <div class="input-group">
                            <select class="form-control" name="category_id" id="category_id">
        
                                @foreach ($categories as $category)
                                
                                <option value= "{{ $category->id }}"
                                    @if(isset($item->categories_id) && "$item->categories_id" === "$category->id")
                                    selected
                                    @endif
                                    >{{ $category->name }}</option>
                                @endforeach

                            </select>
                        </div>

                    </div>
                </div>
            </div>

            <div class="card mb-3">
                <div class="card-header"><label for="detail">詳細</label></div>
                <div class="card-body">
                    <div class="form-group">
                        <textarea name="detail" class="form-control" id="detail" cols="30" rows="10" maxlength="500">{{ old('detail', $item->detail)}}</textarea>
                        <p class="text-muted">※500文字以内で書いてください。（改行は文字数に含まれます。）</p>
                    </div>
                </div>
            </div>

            <div class="card mb-3">
                <div class="card-header"><label for="detail">ステータス</label></div>
                <div class="card-body">

                    <div class="form-group">
                        <select class="form-control" name="status" id="status">
                            
                            <option value="negative"
                                @if ($item->status === 'negative')
                                    selected
                                @endif
                                >
                                非公開
                            </option>

                            <option value= "active"
                                @if ($item->status === 'active')
                                    selected
                                @endif
                                >
                                公開
                            </option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary mb-3 mr-3 w-25">登録</button>
                <a href="{{ url('items/management') }}" class="btn btn-secondary mb-3 mr-3 w-25">戻る</a>
            </div>
        </form>
        
    </div>
</div>
@stop

@section('css')
@stop

@section('js')
@stop
