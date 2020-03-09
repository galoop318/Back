<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\NewsController;

Route::get('/','FrontController@index');


Route::get('/news', 'FrontController@news'); //List Page
Route::get('/news/{id}', 'FrontController@news_detail'); //Content Page

Route::get('/products', 'FrontController@products');
Route::get('/products/{id}', 'FrontController@products_detail');

Auth::routes();










Route::group(['middleware' => ['auth'],'prefix' => 'home'],function(){
    // 首頁
    Route::get('/', 'HomeController@index');

    // 最新消息管理
    Route::get('news', 'NewsController@index');

    //新增與儲存功能
    Route::get('news/create', 'NewsController@create');
    Route::post('news/store', 'NewsController@store');

    //編輯與更新
    Route::get('news/edit/{id}','NewsController@edit');
    Route::post('news/update/{id}','NewsController@update');


    Route::post('news/delete/{id}','NewsController@delete');

    Route::post('ajax_delete_news_imgs','NewsController@ajax_delete_news_imgs');
    Route::post('ajax_post_sort','NewsController@ajax_post_sort');

    Route::post('ajax_upload_img','UploadImgController@ajax_upload_img');
    Route::post('ajax_delete_img','UploadImgController@ajax_delete_img');


    //產品管理
    Route::get('products', 'ProductController@index');

    Route::get('products/create', 'ProductController@create');
    Route::post('products/store', 'ProductController@store'); 

    Route::get('products/edit/{id}','ProductController@edit');
    Route::post('products/update/{id}','ProductController@update');

    Route::post('products/delete/{id}','ProductController@delete');


    //產品類型管理
    Route::get('productType', 'ProductTypeController@index');

    Route::get('productType/create', 'ProductTypeController@create');
    Route::post('productType/store', 'ProductTypeController@store');

    Route::get('productType/edit/{id}','ProductTypeController@edit');
    Route::post('productType/update/{id}','ProductTypeController@update');

    Route::post('productType/delete/{id}','ProductTypeController@delete');
});
