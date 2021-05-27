<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\View;
use App\Facades\CategoryService;
use App\Facades\MenuService;
use Illuminate\Support\Facades\Cache;
use Laracasts\Utilities\JavaScript\JavaScriptFacade;


class SiteController extends Controller
{
    public function __construct() {
        //Cache::flush();
        View::share([
            'menu'=> MenuService::getMenu(),
            'footer_menu'=> MenuService::getFooterMenu(),
            'categories' => CategoryService::getCategories(),
        ]);
        JavaScriptFacade::put([
            'homedir' => route('home'),
        ]);
    }

}
