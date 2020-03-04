<?php

namespace App\Http\Controllers;

use App\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index(){
        $all_news = News::all();
        return view('admin/news/index',compact('all_news'));
    }

    public function create(){
        return view('admin/news/create');
    }

    public function store(Request $request){
        $news_data = $request->all();
        News::create($news_data)->save();
        return redirect('/home/news');
    }

    public function edit($id){

        // $news = News::where('id','=',$id)->first();
        $news = News::find($id);

        return view('admin/news/edit',compact('news'));
    }

    // 更新最新消息
    public function update(Request $request,$id){

        // 第一種寫法
        // $news = News::find($id);
        // $news->img = $request->img;
        // $news->title = $request->title;
        // $news->content = $request->content;
        // $news->save();

        // 第二種寫法
        News::find($id)->update($request->all());

        return redirect('/home/news');

    }

    // 刪除最新消息的
    public function delete(Request $request,$id){
        // dd($id);
        News::find($id)->delete();

        return redirect('/home/news');
    }
}
