<?php

namespace App\EModels;

use Illuminate\Database\Eloquent\Model;

class PayMethod extends Model
{
    protected $table = 'pay_methods';
    protected $fillable = ['title', 'alias', 'description'];
}
