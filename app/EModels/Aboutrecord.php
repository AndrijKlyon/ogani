<?php

namespace App\EModels;

use Illuminate\Database\Eloquent\Model;

class Aboutrecord extends Model
{
    protected $table = 'aboutrecords';
    protected $fillable = ['title', 'img','description', 'text'];
}
