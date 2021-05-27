<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class RecentlyViewedService extends Facade {
   protected static function getFacadeAccessor() { return 'RecentlyViewedService'; }
}
