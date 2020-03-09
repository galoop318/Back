<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product_types extends Model
{
    protected $table = 'Product_types';

    protected $fillable = [
        'types','sort'
    ];
}
