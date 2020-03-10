<?php

namespace App\Http\Controllers;

use App\Products;
use App\Product_types;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function index()
    {
        $products = Products::all();
        return view('admin/products/index', compact('products'));
    }

    public function create()
    {
        $types = Product_types::all();

        return view('admin/products/create',compact('types'));
    }

    public function store(Request $request)
    {
        $Products_data = $request->all();
        // dd($Products_data);
        //暴力移檔 上傳主要圖片
        if ($request->hasFile('img')) {
            $file = $request->file('img');
            $path = $this->fileUpload($file, 'products');
            $Products_data['img'] = $path;
        }

        $Products_id = Products::create($Products_data);

        $Products_id->save();

        // if ($request->hasFile('news_img')) {


        //     $moreimgs = $request->file('news_img');

        //     foreach ($moreimgs as $moreimg) {

        //         $path = $this-> fileUpload($moreimg, 'news');


        //         $newsimg = new News_img;
        //         $newsimg->news_id = $News_id->id;
        //         $newsimg->img_url = $path;
        //         $newsimg->save();
        //     }
        // }

        return redirect('/home/products');
    }

    public function edit($id)
    {

        // $news = News::where('id','=',$id)->first();
        $types = Product_types::all();
        $products = Products::with("products_types")->find($id);


        return view('admin/products/edit', compact('products'),compact('types'));
    }


    public function update(Request $request, $id)
    {

        // 第一種寫法
        // $news = News::find($id);
        // $news->img = $request->img;
        // $news->title = $request->title;
        // $news->content = $request->content;
        // $news->save();


        $request_data = $request->all();
        $item = Products::find($id);

        //if 有上傳新圖片
        if ($request->hasFile('img')) {
            //刪除舊有圖片
            $old_image = $item->img;
            File::delete(public_path() . $old_image);

            //上傳新圖片
            $file = $request->file('img');
            $path = $this->fileUpload($file, 'products');
            $request_data['img'] = $path;
        }

        //update 多張圖片
        // if ($request->hasFile('news_img')) {


        //     $moreimgs = $request->file('news_img');

        //     foreach ($moreimgs as $moreimg) {

        //         $path = $this-> fileUpload($moreimg, 'news');


        //         $newsimg = new News_img;
        //         $newsimg->news_id = $item ->id;
        //         $newsimg->img_url = $path;
        //         $newsimg->save();
        //     }
        // }


        $item->update($request_data);

        return redirect('/home/products');
    }


    public function delete(Request $request, $id)
    {

        $item = Products::find($id);

        $old_image = $item->img;

        if (file_exists(public_path() . $old_image)) {
            File::delete(public_path() . $old_image);
        }

        $item->delete();

        // $news_imgs = News_img::where('news_id',$id)->get();
        // foreach($news_imgs as $news_img){
        //     $old_news_img = $news_img->img_url;
        //     if(file_exists(public_path().$old_news_img)){
        //         File::delete(public_path().$old_news_img);
        //     }

        //     $news_img->delete();
        // }

        return redirect('/home/products');
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
