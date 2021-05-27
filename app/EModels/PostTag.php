<?php

namespace App\EModels;

use Illuminate\Database\Eloquent\Model;

class PostTag extends Model
{
    protected $table = 'post_tags';
    protected $fillable = ['title', 'alias','keywords','description', 'status'];
}
