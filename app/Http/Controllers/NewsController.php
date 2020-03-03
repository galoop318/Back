<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index(){
        return view('admin/news/index');
    }

    public function create(){
        return view('admin/news/create');
    }

    public function store(Request $request){
        $news_data = $request->all();
        News::create($news_data)->save();
        return redirect('/home/news');
    }
}
