<?php

namespace App\EModels;

use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    protected $table = 'order_statuses';
    protected $fillable = ['title', 'alias', 'description', 'color'];
}
