@extends('adminlte::page')

@section('title', '商品管理')

@section('content_header')
<div class="d-flex justify-content-between">
    <h1>商品管理</h1>
    <a class="btn btn-primary" data-toggle="collapse" href="#collapseExample">  
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
            
                <form method="POST" action="{{ url('items/management')}}" onsubmit="return">
                    @csrf
                    <input type="hidden" name="type" value="search" >
    
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
                            <label class="col-form-label col-sm-2" for="category_id">カテゴリー:</label>
                            <div class="col-sm-10">
    
                                <select class="form-control" name="category_id" id="category_id">

                                    <option value="">全て</option>

                                    @foreach ($categories as $category)
                                    <option value= "{{ $category->id }}"
                                        @if(isset($category_id) && "$category_id" === "$category->id")
                                        selected
                                        @endif
                                        >{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-form-label col-sm-2" for="status">ステータス:</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="status" id="status">
                            
                                    <option value="">全て</option>

                                    <option value="negative"
                                        @if (isset($status) && $status === 'negative')
                                            selected
                                        @endif
                                        >
                                        非公開
                                    </option>
        
                                    <option value= "active"
                                        @if (isset($status) && $status === 'active')
                                            selected
                                        @endif
                                        >
                                        公開
                                    </option>
                                </select>
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
                            <a href="{{ url('items/management')}}" class="btn btn-secondary m-1">リセット</a>
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
                    <th>商品名</th>
                    <th>カテゴリー</th>
                    <th>ステータス</th>
                    <th>登録日時</th>
                    <th>操作</th>
                    
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)
                    <tr>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->categories_name}}</td>
                        <td>
                            @if($item->status === 'negative')
                                <p>非公開</p>
                            @elseif($item->status === 'active')
                                <p>公開</p>
                            @endif
                        </td>
                        <td>{{ $item->created_at }}</td>
                        
                        <td class="d-flex">
                            {{-- 商品詳細 --}}
                            <div style="margin-right: 5px">
                                <a href="{{ url('items/detail', ['id' => $item->id, 'role' => 1])}}"  class="btn btn-default">詳細</a>
                            </div>

                            {{-- 商品編集 --}}
                            <div style="margin-right: 5px">
                                <a href="{{ url('items/edit', ['id' => $item->id]) }}" class="btn btn-default">編集</a>
                            </div>

                            {{-- 商品削除 --}}
                            <div>
                                <form action="{{ url('items/management') }}" method="POST" onsubmit="return confirm('「{{$item->name}}」を削除します。よろしいですか？')">
                                    @csrf
                                    <input type="hidden" name="type" value="delete" >
                                    <input type="hidden" name="id" value="{{ $item->id }}">
                                    <input type="submit" value="削除" class="btn btn-danger">
                                </form>
                            </div>
                        </td>

                    </tr>
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
