<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class PayMethodService extends Facade {
   protected static function getFacadeAccessor() { return 'PayMethodService'; }
}
