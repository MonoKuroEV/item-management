{{-- ホーム画面 --}}

@extends('adminlte::page')

@section('title', 'カテゴリー管理')

@section('content_header')
<div class="d-flex justify-content-between">
    <h1>カテゴリー管理</h1>
    <a class="btn btn-primary m-1" data-toggle="collapse" href="#collapseExample">  
        <i class="fa fa-plus "></i> 
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
        @if($errors->has('name'))
        show
        @endif
        " id="collapseExample">

            <form method="POST" action="{{ url('categories/') }}" onsubmit="return confirm('カテゴリーを登録します。よろしいですか？')">
                @csrf

                <input type="hidden" name="type" value="add" >

                <div class="card mb-3">
                    <div class="card-header"><label for="name">新規登録</label></div>
                    <div class="card-body">
                        <div class="input-group">
                            <input type="text" class="form-control" id="name" name="name" placeholder="カテゴリー名を入力">
                            <button type="submit" class="btn btn-primary">登録</button>
                        </div>
                        @if ($errors->has('name'))
                            <p class="alert-danger rounded mt-1 p-2">{{ $errors->first('name')}}</p>
                        @endif
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="mb-3">
    <form method="POST" action="{{ url('categories/') }}" onsubmit="return">
        @csrf
        
        <input type="hidden" name="type" value="search" >

            <div class="input-group">
                <input type="search" class="form-control" id="keyword" name="keyword" placeholder="検索キーワードを入力"
                    @if(isset($keyword))
                    value="{{ $keyword }}"
                    @endif>
                <button type="submit" class="btn btn-primary mr-1">検索</button>
                <a href="{{ url('/categories')}}" class="btn btn-secondary">リセット</a>
            </div>
    </form>
</div>


<div class="card">
    <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap table-striped" >
            <thead>
                <tr>
                    <th>カテゴリー名</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                <tr>
                    <td>{{ $category->name }}</td>
                    <td class="d-flex ">
                        @if(!($category->name === "no-category"))
                        
                        {{-- 商品編集 --}}
                        <div style="margin-right: 5px">
                            <a href="{{ url('categories/edit', ['id' => $category->id]) }}" class="btn btn-default">編集</a>
                        </div>
                        
                        {{-- 商品削除 --}}
                        <div>
                            <form action="{{ url('categories') }}" method="POST" 
                                onsubmit="return confirm('「{{ $category->name }}」を削除します。よろしいですか？\n登録されていた商品のカテゴリーは「no-caregory」になります。')">
                                @csrf
                                {{-- 送信方式 --}}
                                @method('PUT')

                                <input type="hidden" name="type" value="delete" >
                                <input type="hidden" name="id" value="{{ $category->id }}">
                                <input type="submit" value="削除" class="btn btn-danger">
                            </form>
                        </div>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop

