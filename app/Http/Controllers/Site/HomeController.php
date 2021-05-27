<?php

namespace App\Http\Controllers\Site;

use App\EModels\Product;
use App\Http\Controllers\Site\SiteController;

use App\Facades\BannerService;
use App\Facades\CategoryService;
use App\Facades\PostService;
use App\Facades\ProductService;
use App\Facades\WeekDealService;

class HomeController extends SiteController
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('site.home.index', [
            'featured_products' => CategoryService::addParentCategories(ProductService::getFeaturedProducts()),
            'latest_products' => ProductService::getLatestProducts(),
            'offer_products' => ProductService::getOfferProducts(),
            'popular_products' => ProductService::getPopularProducts(),
            'banners' => BannerService::getBanners(),
            'meta' => [
                'title' => config('template_settings.site.title'),
                'keywords' => config('template_settings.site.keywords'),
                'description' => config('template_settings.site.description'),
            ],
            'posts' => PostService::getLatestPosts(),
            'mainpage' => true,
            'weekdeal_product' => ProductService::getWeekDealProduct(WeekDealService::getWeekDeal()),
        ]);
    }

}
