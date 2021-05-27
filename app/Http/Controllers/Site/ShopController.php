<?php

namespace App\Http\Controllers\Site;

use App\EModels\Shopinfo;
use App\Facades\CategoryService;
use App\Facades\PostService;
use App\Http\Controllers\Site\SiteController;
use Illuminate\Http\Request;

class ShopController extends SiteController
{

    public function shopinfo(Request $request) {
        $shopinfo = Shopinfo::where('alias', $request->alias)->firstOrFail();
        return view('site.shop.index', [
            'shopinfo' => $shopinfo,
            'meta' => [
                'title' => config('template_settings.site.title') . ' - ' . $shopinfo->title,
                'keywords' => $shopinfo->keywords,
                'description' => $shopinfo->description
            ],
            'breadcrumb_title' => $shopinfo->title,
            'categories' => CategoryService::getCategories(),
            'popular_posts' => PostService::getPopularPosts()
        ]);
    }
}
