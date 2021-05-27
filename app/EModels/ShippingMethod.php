<?php

namespace App\EModels;

use Illuminate\Database\Eloquent\Model;

class ShippingMethod extends Model
{
    protected $table = 'shipping_methods';
    protected $fillable = ['title', 'alias', 'description', 'price'];
}
