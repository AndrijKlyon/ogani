<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class RatingService extends Facade {
   protected static function getFacadeAccessor() { return 'RatingService'; }
}
