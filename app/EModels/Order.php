<?php

namespace App\EModels;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = ['user_id', 'status_id','shipping_method','pay_method','note','pay_status','amount'];

    public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }

    public function status()
    {
        return $this->hasOne('App\EModels\OrderStatus', 'id', 'status_id');
    }

    public function products() {
        return $this->hasMany('App\EModels\OrderProduct', 'order_id', 'id');
    }

}
