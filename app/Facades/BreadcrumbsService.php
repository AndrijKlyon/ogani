<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class BreadcrumbsService extends Facade {
   protected static function getFacadeAccessor() { return 'BreadcrumbsService'; }
}
