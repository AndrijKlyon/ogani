<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class PostCategoryService extends Facade {
   protected static function getFacadeAccessor() { return 'PostCategoryService'; }
}
