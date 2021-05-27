<?php

namespace App\EModels;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $table = 'banners';
    protected $fillable = ['model_type', 'model_id'];

    public $timestamps = false;
}
