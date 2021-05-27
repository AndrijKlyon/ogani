<?php

namespace App\EModels;

use Illuminate\Database\Eloquent\Model;

class Shopinfo extends Model
{
    protected $table = 'shopinfos';
    protected $fillable = ['title', 'alias', 'description', 'img', 'user_id', 'text'];

    public function author() {
        return $this->hasOne('App\User','id', 'user_id');
    }
}
