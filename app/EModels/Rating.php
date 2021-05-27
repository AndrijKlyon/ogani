<?php

namespace App\EModels;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $table = 'ratings';

    public function user() {
        return $this->hasOne('App\User','id','user_id');
    }

    public function product() {
        return $this->hasOne('App\EModels\Product','id','rateable_id');
    }

}
