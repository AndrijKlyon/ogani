<?php

namespace App\EModels;

use Illuminate\Database\Eloquent\Model;
use Laravelista\Comments\Commentable;

use CyrildeWit\EloquentViewable\InteractsWithViews;
use CyrildeWit\EloquentViewable\Contracts\Viewable;

use Illuminate\Support\Str;

class Post extends Model implements Viewable
{
    use Commentable, InteractsWithViews;

    protected $table = 'posts';
    protected $fillable = ['title', 'alias','img', 'keywords','description', 'user_id', 'category_id', 'text', 'status','hit', 'quote'];

    public function author() {
        return $this->hasOne('App\User','id', 'user_id');
    }

    public function category() {
        return $this->hasOne('App\EModels\PostCategory','id', 'category_id');
    }

    public function images() {
        return $this->hasMany('App\EModels\PostImage','post_id', 'id');
    }

    public function tags() {
        return $this->hasManyThrough('App\EModels\PostTag',
                                    'App\EModels\Post_Tag',
                                    'post_id',
                                    'id',
                                    'id',
                                    'tag_id'
                                    );
    }

    public function getAuthorNameAttribute()
    {
        return $this->author->firstname . ' ' . $this->author->lastname;
    }

    public function getIntroAttribute()
    {
        return Str::limit($this->text, 140);
    }

    public function getIntroSmallAttribute()
    {
        return Str::limit($this->text, 30);
    }

    public function related() {
        return $this->hasManyThrough('App\EModels\Post',
                                    'App\EModels\Post_Tag',
                                    'tag_id',
                                    'id',
                                    'id',
                                    'post_id'
                                    )->latest('id')
                                    ->take(4);
    }

}
