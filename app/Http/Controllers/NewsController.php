<?php

namespace App\Http\Controllers;

use App\News;
use App\News_img;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        $all_news = News::all();
        return view('admin/news/index', compact('all_news'));
    }

    public function create()
    {
        return view('admin/news/create');
    }

    public function store(Request $request)
    {
        $news_data = $request->all();

        // 單檔上傳
        // dd($request->all());
        $file_name = $request->file('img')->store('', 'public');
        $news_data['img'] = $file_name;

        
        $News_id = News::create($news_data);

        $News_id->save();
        //如果有上傳 執行下方
        if ($request->hasFile('news_img')) {
            // dd($request->file('news_img'));

            $moreimgs = $request->file('news_img');
            foreach ($moreimgs as $moreimg) {
                //上傳圖片
                $file_name = $moreimg->store('', 'public');

                //新增資料進DB
                $newsimg = new News_img;
                $newsimg->news_id = $News_id['id'];
                $newsimg->img_url = $file_name;
                $newsimg->save();
            }
        }





        return redirect('/home/news');
    }

    public function edit($id)
    {

        // $news = News::where('id','=',$id)->first();
        $news = News::find($id);

        return view('admin/news/edit', compact('news'));
    }

    // 更新最新消息
    public function update(Request $request, $id)
    {

        // 第一種寫法
        // $news = News::find($id);
        // $news->img = $request->img;
        // $news->title = $request->title;
        // $news->content = $request->content;
        // $news->save();

        // 第二種寫法
        News::find($id)->update($request->all());


        // 更新圖片的時候 要先找到舊的圖片 再丟回新的圖片

        return redirect('/home/news');
    }

    // 刪除最新消息的
    public function delete(Request $request, $id)
    {
        // dd($id);
        News::find($id)->delete();

        return redirect('/home/news');
    }
}
