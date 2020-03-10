<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $table = 'Products';

    protected $fillable = [
        'types_id','img','title','content','sort'
    ];

    public function products_types(){
        return $this->belongsTo('App\Product_types','types_id');
    }

}
