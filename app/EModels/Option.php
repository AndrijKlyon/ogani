<?php

namespace App\EModels;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    protected $table = 'options';
    protected $fillable = ['title', 'alias','img','description'];
}
