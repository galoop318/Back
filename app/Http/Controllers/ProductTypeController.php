<?php

namespace App\Http\Controllers;

use App\Product_types;
use Illuminate\Http\Request;

class ProductTypeController extends Controller
{
    public function index()
    {
        $items = Product_types::all();
        return view('admin/productType/index',compact('items'));
    }

    public function create()
    {
        return view('admin/productType/create');
    }

    public function store(Request $request)
    {

        $types = $request->all();

        $product_types = Product_types::create($types);

        $product_types->save();

        return redirect('/home/productType');
    }

    // 刪除產品類型
    public function delete(Request $request, $id)
    {
        // dd($id);
        $item = Product_types::find($id);

        $item->delete();

        return redirect('/home/productType');
    }
}
