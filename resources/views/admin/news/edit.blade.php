@extends('layouts/app')



@section('content')

<div class="container">
    <h1>編輯最新消息</h1>
    <form method="POST" action="/home/news/update/{{$news->id}}">
        @csrf
        <div class="form-group">
          <label for="img">現有圖片</label>
          <img class="img-fluid" src="/storage/{{$news->img}}" alt="">
        </div>

        <div class="form-group">
            <label for="title">重新上傳圖片</label>
            <input type="file" class="form-control" id="img" name="img">
        </div>

        <div class="form-group">
          <label for="title">Email address</label>
          <input type="text" class="form-control" id="title" name="title" value="{{$news->title}}">
        </div>

        <div class="form-group">
            <label for="sort">sort</label>
            <input type="number" class="form-control" id="sort" name="sort" value="{{$news->sort}}">
          </div>

        <div class="form-group">
            <label for="content">Password</label>
            <textarea class="form-control" name="content" id="content" cols="30" rows="10">{{$news->content}}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>


@endsection


