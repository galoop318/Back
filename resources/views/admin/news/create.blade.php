@extends('layouts/app')

@section('css')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.css" rel="stylesheet">
@endsection


@section('content')

<div class="container">
    <h1>新增最近消息</h1>
    <form method="POST" action="/home/news/store" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="img">主要圖片上傳</label>
            <input type="file" class="form-control" id="img" name="img">
        </div>

        <div class="form-group">
            <label for="img">多張圖片上傳</label>
            <input type="file" class="form-control" id="news_img" name="news_img[]" multiple>
        </div>

        <div class="form-group">
            <label for="title">Email address</label>
            <input type="text" class="form-control" id="title" name="title">
        </div>

        <div class="form-group">
            <label for="content">Password</label>
            <textarea class="form-control" id="content" name="content"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>


@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.js"></script>

<script>
    $(document).ready(function() {
    $('#content').summernote({
        minHeight: 300,
    });

    });
</script>

@endsection
