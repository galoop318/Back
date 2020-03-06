@extends('layouts/nav')

@section('content')
<section class="engine"><a href="https://mobirise.info/x">css templates</a></section><section class="features3 cid-rRF3umTBWU" id="features3-7" style="margin-top:80px">

    <div class="container">
        <div class="media-container-row">
            title:{{$news->title}}
            <br>
            多張圖片：

            @foreach ($news->news_imgs as $news_img)
                <img width="100" src="{{$news_img->img_url}}" alt="">
            @endforeach

        </div>

    </div>
</section>
@endsection



