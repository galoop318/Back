<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table = 'news';

    protected $fillable = [
        'img','title','content','sort'
    ];

    public function news_imgs(){
        //要先經過排序orderby再丟回newscontroller裡的edit function
        return $this->hasMany('App\News_img')->orderby('sort','desc');

    }
}
