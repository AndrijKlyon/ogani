<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class WishListService extends Facade {
   protected static function getFacadeAccessor() { return 'WishListService'; }
}
