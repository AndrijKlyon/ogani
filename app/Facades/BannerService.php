<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class BannerService extends Facade {
   protected static function getFacadeAccessor() { return 'BannerService'; }
}
