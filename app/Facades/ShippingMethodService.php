<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class ShippingMethodService extends Facade {
   protected static function getFacadeAccessor() { return 'ShippingMethodService'; }
}
