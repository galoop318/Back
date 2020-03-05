@extends('layouts/app')

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
@endsection

@section('content')
<div class="container">
    <a href="/home/news/create" class="btn btn-success">新增</a>
    <hr>
    <table id="example" class="table table-striped table-bordered" style="width:100%">

    <thead>
        <tr>
            <th>img</th>
            <th>title</th>
            <th>content</th>
            <th>sort</th>
            <th></th>

        </tr>
    </thead>
    <tbody>

        @foreach ($all_news as $item)
            <tr>
                <td>
                <img width="100px" src="{{$item->img}}" alt="">
                </td>
                <td>{{$item->title}}</td>
                <td>{{$item->content}}</td>
                <td>{{$item->sort}}</td>
                <td width="120px">
                    <a href="/home/news/edit/{{$item->id}}" class="btn btn-warning ">修改</a>
                    <button class="btn btn-danger" onclick="show_confirm({{$item->id}})">刪除</button>
                    {{-- 建立隱藏的刪除表單-抓每一筆的ID-在執行刪除的動作 --}}
                    <form id="delete-form-{{$item->id}}" action="/home/news/delete/{{$item->id}}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </td>

            </tr>
        @endforeach


    </tbody>

</table>
</div>


@endsection

@section('js')

    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>

    <script>
    $(document).ready(function() {
        $('#example').DataTable();
    } );

    // 刪除時會跳出視窗詢問
    function show_confirm(id){
        var r=confirm("你確定要刪除嗎!")
        if (r==true){
            document.getElementById(`delete-form-${id}`).submit();
        }
    }

    </script>

@endsection
