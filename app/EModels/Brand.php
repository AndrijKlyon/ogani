<?php

namespace App\EModels;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $table = 'brands';
    protected $fillable = ['title', 'alias','img','description','keywords'];
}
