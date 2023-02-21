{{-- ホーム画面 --}}

@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>最近追加された商品</h1>
@stop

@section('content')

<div class="card">
    <div class="card-body table-responsive p-0">
        <table class="table  table-hover text-nowrap table-striped" >
            <thead>
                <tr>
                    <th>商品名</th>
                    <th>カテゴリー</th>
                    <th>登録日時</th>
                    <th>操作</th>
                    
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)

                    <tr>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->categories_name}}</td>
                        <td>{{ $item->created_at}}</td>
                        <td>
                            {{-- 商品詳細 --}}
                            <div>
                                <a href="{{ url('items/detail', ['id' => $item->id, 'role' => 0])}}"  class="btn btn-default">詳細</a>
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
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop

