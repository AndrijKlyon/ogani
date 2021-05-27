<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class UserAvatarService extends Facade {
   protected static function getFacadeAccessor() { return 'UserAvatarService'; }
}
