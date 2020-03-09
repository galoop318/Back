<?php

namespace App\Http\Controllers;

use App\Products;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Products::all();
        return view('admin/products/index', compact('products'));
    }

    public function create()
    {
        return view('admin/products/create');
    }

    public function store(Request $request)
    {
        $Products_data = $request->all();

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



    public function delete(Request $request, $id)
    {
        // dd($id);
        $item = Products::find($id);

        $old_image = $item->img;
        if (file_exists(public_path() . $old_image)) {
            File::delete(public_path() . $old_image);
        }

        $item->delete();

        $news_imgs = News_img::where('news_id',$id)->get();
        foreach($news_imgs as $news_img){
            $old_news_img = $news_img->img_url;
            if(file_exists(public_path().$old_news_img)){
                File::delete(public_path().$old_news_img);
            }

            $news_img->delete();
        }

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
