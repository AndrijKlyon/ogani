<?php

namespace App\EModels;

use Illuminate\Database\Eloquent\Model;

class PostCategory extends Model
{
    protected $table = 'post_categories';
    protected $fillable = ['title', 'alias','keywords','description', 'status'];

    public function posts() {
        return $this->hasMany('App\EModels\Post','category_id', 'id');
    }

}
