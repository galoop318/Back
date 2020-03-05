<?php

namespace App\Http\Controllers;

use App\News;
use App\News_img;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

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

        // 傳統單檔上傳
        // dd($request->all());
        //$file_name = $request->file('img')->store('', 'public');
        //$news_data['img'] = $file_name;

        //暴力移檔
        if ($request->hasFile('img')) {
            $file = $request->file('img');
            $path = $this->fileUpload($file, 'news');
            $news_data['img'] = $path;
        }

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


        $request_data = $request->all();
        $item = News::find($id);

        //if 有上傳新圖片，刪掉舊圖片，再上傳新圖片
        if ($request->hasFile('img')) {
            //刪除舊有圖片
            $old_image = $item->img;
            File::delete(public_path() . $old_image);
            //上傳新圖片
            $file = $request->file('img');
            $path = $this->fileUpload($file, 'news');
            $request_data['img'] = $path;
        }

        $item->update($request_data);


        return redirect('/home/news');
    }

    // 刪除最新消息的
    public function delete(Request $request, $id)
    {
        // dd($id);
        $item = News::find($id);

        $old_image = $item->img;
        if (file_exists(public_path() . $old_image)) {
            File::delete(public_path() . $old_image);
        }

        $item->delete();

        return redirect('/home/news');
    }



    private function fileUpload($file, $dir)
    {
        //防呆：資料夾不存在時將會自動建立資料夾，避免錯誤
        if (!is_dir('upload/')) {
            mkdir('upload/');
        }
        //防呆：資料夾不存在時將會自動建立資料夾，避免錯誤
        if (!is_dir('upload/' . $dir)) {
            mkdir('upload/' . $dir);
        }
        //取得檔案的副檔名
        $extension = $file->getClientOriginalExtension();
        //檔案名稱會被重新命名
        $filename = strval(time() . md5(rand(100, 200))) . '.' . $extension;
        //移動到指定路徑
        move_uploaded_file($file, public_path() . '/upload/' . $dir . '/' . $filename);
        //回傳 資料庫儲存用的路徑格式
        return '/upload/' . $dir . '/' . $filename;
    }
}
