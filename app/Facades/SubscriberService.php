<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class SubscriberService extends Facade {
   protected static function getFacadeAccessor() { return 'SubscriberService'; }
}
