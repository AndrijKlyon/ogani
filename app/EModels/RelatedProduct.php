<?php

namespace App\EModels;

use Illuminate\Database\Eloquent\Model;

class RelatedProduct extends Model
{
    protected $table = 'related_products';

    public function category() {
        return $this->hasOne('App\EModels\Category','id', 'category_id');
    }

    public function images() {
        return $this->hasMany('App\EModels\ProductImage','product_id', 'id');
    }

    public function products() {
        return $this->hasMany('App\EModels\Product','related_id', 'id');
    }
}
