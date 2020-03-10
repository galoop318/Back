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
    <h1>編輯產品</h1>
    <form method="POST" action="/home/products/update/{{$products->id}}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="img">現有主要圖片</label>
            <img class="img-fluid" width="250" src="{{$products->img}}" alt="">
        </div>

        <div class="form-group">
            <label for="title">重新上傳主要圖片</label>
            <input type="file" class="form-control" id="img" name="img">
        </div>
        <hr>
        {{-- <div class="row">
            現有多張圖片組
            @foreach ($news->news_imgs as $item)
            <div class="col-2">
                <div class="news_img_card" data-newsimgid="{{$item->id}}">
                <button type="button" class="btn btn-danger" data-newsimgid="{{$item->id}}">Ｘ</button>
                    <img class="img-fluid" width="250" src="{{$item->img_url}}" alt="">
                    <input class="form-control" type="text" value="{{$item->sort}}"
                        onchange="ajax_post_sort(this,{{$item->id}})">
                </div>
            </div>
            @endforeach
        </div>
        <div class="form-group">
            <label for="title">新增多張圖片組</label>
            <input type="file" class="form-control" id="news_img" name="news_img[]" multiple>
        </div> --}}
        <hr>

        <div class="form-group">
            <label for="exampleFormControlSelect1">Example select</label>
            <select class="form-control" id="exampleFormControlSelect1" name="types_id">
                @foreach ($types as $item)

                    @if($item->id == $products->types_id)
                    <option value="{{$item->id}}" selected>
                        {{$item->types}}
                    </option>

                    @else
                    <option value="{{$item->id}}">
                        {{$item->types}}
                    </option>
                    @endif

                @endforeach

            </select>
        </div>

        <div class="form-group">
            <label for="title">Email address</label>
            <input type="text" class="form-control" id="title" name="title" value="{{$products->title}}">
        </div>

        <div class="form-group">
            <label for="sort">sort</label>
            <input type="number" class="form-control" id="sort" name="sort" value="{{$products->sort}}">
        </div>

        <div class="form-group">
            <label for="content">Password</label>
            <textarea class="form-control" name="content" id="content" cols="30" rows="10">{{$products->content}}</textarea>
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
