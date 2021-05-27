<?php

namespace App\EModels;

use willvincent\Rateable\Rateable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Laravelista\Comments\Commentable;
use CyrildeWit\EloquentViewable\InteractsWithViews;
use CyrildeWit\EloquentViewable\Contracts\Viewable;

class Product extends Model implements Viewable
{
    use Rateable, Commentable, InteractsWithViews;
    protected $table = 'products';
    protected $fillable = ['category_id', 'brand_id','title', 'alias', 'content', 'price', 'special_price', 'status', 'keywords', 'description', 'collection_id', 'hit'];

    public function category() {
        return $this->hasOne('App\EModels\Category','id', 'category_id');
    }

    public function images() {
        return $this->hasMany('App\EModels\ProductImage','product_id', 'id');
    }

    public function getFirstImageAttribute() {
        return $this->images()->first()['img'];
    }

    public function specifications() {
        return $this->hasMany('App\EModels\Specification', 'product_id', 'id');
    }

    public function brand() {
        return $this->hasOne('App\EModels\Brand','id', 'brand_id');
    }

    public function modifications() {
        return $this->hasMany('App\EModels\Modification','product_id', 'id');
    }


    public function options() {
        return $this->hasManyThrough('App\EModels\Option',
                                    'App\EModels\Modification',
                                    'product_id',
                                    'id',
                                    'id',
                                    'option_id'
                                    );
    }


    public function scopePriceBetween(Builder $query, $start, $end): Builder {
        return $query->whereBetween('price', [$start, $end]);
    }

    public function scopeOffers(Builder $query): Builder {
        return $query->where('special_price', '!=', 0);
    }

    public function ratings() {
        return $this->hasMany('App\EModels\Rating','rateable_id', 'id');
    }

    public function getAverRatingAttribute() {
        return round($this->ratings->where('rateable_type', 'App\EModels\Product')->avg('rating'));
    }

    public function related() {
        return $this->hasManyThrough('App\EModels\Product',
                                    'App\EModels\RelatedProduct',
                                    'product_id',
                                    'id',
                                    'id',
                                    'related_id'
                                    );
    }

}
