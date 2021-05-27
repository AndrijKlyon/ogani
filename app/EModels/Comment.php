<?php

namespace App\EModels;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';
    protected $fillable = ['comment', 'viewed'];

    public function user()
    {
        return $this->hasOne('App\User', 'id', 'commenter_id');
    }

    public function scopeParent(Builder $query, $id): Builder {
        return $query->where('id', $id);
    }

    public function commentable()
    {
        return $this->morphTo();
    }

}
