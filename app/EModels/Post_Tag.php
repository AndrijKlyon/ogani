<?php

namespace App\EModels;

use Illuminate\Database\Eloquent\Model;

class Post_Tag extends Model
{
    protected $table = 'post_tag';
    protected $fillable = ['post_id', 'tag_id'];
    public $timestamps = false;
}
