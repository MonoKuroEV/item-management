@extends('adminlte::page')

@section('title', '商品登録')

@section('content_header')
    <h1>商品登録</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">

            <form method="POST" action="{{ url('items/add')}}" onsubmit="return confirm('商品を登録します。よろしいですか？')">
                @csrf
                
                <div class="card mb-3">
                    <div class="card-header"><label for="name">商品名</label></div>
                    <div class="card-body">
                        <div class="form-group">
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" placeholder="商品名">
                            @if ($errors->has('name'))
                            <p class="alert-danger rounded mt-1 p-2">{{ $errors->first('name')}}</p>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- カテゴリー --}}
                <div class="card mb-3">
                    <div class="card-header"><label>カテゴリー</label></div>
                    <div class="card-body">
                        <div class="form-group">

                            <div class="input-group">
                                <select class="form-control" name="category_id" id="category_id">
            
                                    @foreach ($categories as $category)
                                    <option value= "{{ $category->id }}"
                                        @if(old('category_id') === "$category->id")
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
                            <textarea name="detail" class="form-control" id="detail" cols="30" rows="10" maxlength="500" placeholder="詳細説明"></textarea>
                            <p class="text-muted">※500文字以内で書いてください。（改行は文字数に含まれます。）</p>
                        </div>
                    </div>
                </div>

                <div class="card mb-3">
                    <div class="card-header"><label for="status">ステータス</label></div>
                    <div class="card-body">
                        <div class="form-group">
                            <select class="form-control" name="status" id="status">
                                <option value="negative" selected>非公開</option>
                                <option value="active">公開</option>
                            </select>
                        </div>
                    </div>
                </div>


                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary mb-3 w-25">登録</button>
                </div>
            </form>
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
@stop
