<?php

namespace App\EModels;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $fillable = ['title', 'alias','img', 'ext_img', 'description','keywords', 'hit', 'ext_hit', 'parent_id'];

    public function products() {
        return $this->hasMany('App\EModels\Product','category_id', 'id');
    }

}
