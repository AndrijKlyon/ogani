<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class OrderStatusService extends Facade {
   protected static function getFacadeAccessor() { return 'OrderStatusService'; }
}
