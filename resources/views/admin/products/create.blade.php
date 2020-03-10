@extends('layouts/app')

@section('css')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.css" rel="stylesheet">
@endsection


@section('content')

<div class="container">
    <h1>新增產品</h1>
    <form method="POST" action="/home/products/store" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="exampleFormControlSelect1">Example select</label>
            <select class="form-control" id="exampleFormControlSelect1" name="types_id">
                @foreach ($types as $item)


                    <option value="{{$item->id}}">{{$item->types}}</option>

                @endforeach

              {{-- <option>1</option>
              <option>2</option>
              <option>3</option>
              <option>4</option>
              <option>5</option> --}}
            </select>
        </div>
        {{-- <div class="form-group">
            <label for="types_id">types_id</label>
            <input type="text" class="form-control" id="types_id" name="types_id">
        </div> --}}

        <div class="form-group">
            <label for="img">主要圖片上傳</label>
            <input type="file" class="form-control" id="img" name="img">
        </div>

        {{-- <div class="form-group">
            <label for="img">多張圖片上傳</label>
            <input type="file" class="form-control" id="news_img" name="news_img[]" multiple>
        </div> --}}

        <div class="form-group">
            <label for="title">title</label>
            <input type="text" class="form-control" id="title" name="title">
        </div>

        <div class="form-group">
            <label for="title">sort</label>
            <input type="text" class="form-control" id="sort" name="sort">
        </div>

        <div class="form-group">
            <label for="content">content</label>
            <textarea class="form-control" id="content" name="content"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>


@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.js"></script>
<script src="{{asset('js/summernote-zh-TW.js')}}"></script>
{{-- 放上翻譯 --}}

<script>
    $(document).ready(function() {


        $('#content').summernote({
            lang:'zh-TW',
            minHeight: 300,
            callbacks: {
                onImageUpload: function(files) {
                    for(let i=0; i < files.length; i++) {
                        $.upload(files[i]);
                    }
                },
                onMediaDelete : function(target) {
                    $.delete(target[0].getAttribute("src"));
                }
            },
        });


        $.upload = function (file) {
            let out = new FormData();
            out.append('file', file, file.name);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            $.ajax({
                method: 'POST',
                url: '/home/ajax_upload_img',
                contentType: false,
                cache: false,
                processData: false,
                data: out,
                success: function (img) {
                    $('#content').summernote('insertImage', img);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.error(textStatus + " " + errorThrown);
                }
            });
        };

        $.delete = function (file_link) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                method: 'POST',
                url: '/home/ajax_delete_img',
                data: {file_link:file_link},
                success: function (img) {
                    console.log("delete:",img);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.error(textStatus + " " + errorThrown);
                }
            });
        }
    });

</script>

@endsection
