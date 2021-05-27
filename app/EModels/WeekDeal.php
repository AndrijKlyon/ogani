<?php

namespace App\EModels;

use Illuminate\Database\Eloquent\Model;

class WeekDeal extends Model
{
    protected $table = 'week_deals';
    protected $fillable = ['product_id', 'ended_at'];

    public function product() {
        return $this->hasOne('App\EModels\Product','id', 'product_id');
    }

}
