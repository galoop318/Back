<?php

namespace App\Http\Controllers;

use App\News;
use App\Products;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index(){
        return view('front/index');
    }

    public function test_goods_detail(){
        return view('front/test_goods_detail');
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
        $Products_data = Products::orderby('sort','desc')->get();
        return view('front/products',compact('Products_data'));
    }

    public function products_detail($id){

        $news = News::find($id);
        // dd($item);
        return view('front/news_detail',compact('news'));
    }

    public function contactus(){
        return view('front/contactus');
    }


    public function add_cart(){
        $Products = Products::find($id); // assuming you have a Product model with id, name, description & price
        $rowId = 456; // generate a unique() row ID
        $userID = 2; // the user ID to bind the cart contents

        \Cart::session($userID)->add(array(
            'id' => $rowId,
            'name' => $Products->name,
            'price' => $Products->price,
            'quantity' => 1,
            'attributes' => array(),
            'associatedModel' => $Products
        ));
    }
}
