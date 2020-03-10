@extends('layouts/app')

@section('css')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.css" rel="stylesheet">
<style>
    .news_img_card .btn-danger {
        position: absolute;
        right: -5px;
        top: -15px;
        border-radius: 50%;
        width: 40px;
        height: 40px;
    }
</style>
@endsection

@section('content')

<div class="container">
    <h1>編輯最新消息</h1>
    <form method="POST" action="/home/productType/update/{{$types->id}}" enctype="multipart/form-data">
        @csrf

        <hr>
        <div class="form-group">
            <label for="types">types</label>
            <input type="text" class="form-control" id="types" name="types" value="{{$types->types}}">
        </div>

        <div class="form-group">
            <label for="sort">sort</label>
            <input type="number" class="form-control" id="sort" name="sort" value="{{$types->sort}}">
        </div>


        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>


@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.js"></script>
<script src="{{asset('js/summernote-zh-TW.js')}}"></script>
<script>
    $(document).ready(function() {
        $('#content').summernote({
            lang:'zh-TW',
            minHeight: 300,
        });

    });
</script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.news_img_card .btn-danger' ).click(function(){

        var newsimgid = this.getAttribute('data-newsimgid')


        $.ajax({
            method: 'POST',
            url: "/home/ajax_delete_news_imgs",
            data: {
                newsimgid: newsimgid,
            },
            success: function (result) {
                $(`.news_img_card[data-newsimgid=${newsimgid}]`).remove();
            },

        });
    })

    function ajax_post_sort(element,img_id){

        var sort_value = element.value;

        $.ajax({
            method: 'POST',
            url: "/home/ajax_post_sort",
            data: {
                id: img_id,
                sort: sort_value,
            },
            success: function (result) {
                console.log(result);
            },
        })
    }

</script>
@endsection
