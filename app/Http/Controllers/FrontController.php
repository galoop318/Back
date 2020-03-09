<?php

namespace App\Http\Controllers;

use App\News;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index(){
        return view('front/index');
    }

    public function news(){
        $news_data = News::orderby('sort','desc')->get();
        return view('front/news',compact('news_data'));
    }

    public function news_detail($id){

        $news = News::find($id);
        // dd($item);
        return view('front/news_detail',compact('news'));
    }


    public function products(){
        $news_data = News::orderby('sort','desc')->get();
        return view('front/products',compact('news_data'));
    }

    public function products_detail($id){ 

        $news = News::find($id);
        // dd($item);
        return view('front/news_detail',compact('news'));
    }
}
