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

});
