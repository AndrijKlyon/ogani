<?php

namespace App\Providers;

// Initial service classes
use App\Services\AdminService;

use App\Services\BreadcrumbsService;
use App\Services\MenuService;
use App\Services\BrandService;
use App\Services\CategoryService;
use App\Services\ProductService;
use App\Services\UserAvatarService;
use App\Services\UserService;
use App\Services\CartService;
use App\Services\WishListService;
use App\Services\OrderService;
use App\Services\RelatedService;
use App\Services\ImageService;
use App\Services\ImagesService;
use App\Services\OrderStatusService;
use App\Services\CommentService;
use App\Services\AboutrecordService;
use App\Services\MailService;
use App\Services\PostService;
use App\Services\OptionService;
use App\Services\PayMethodService;
use App\Services\ModificationService;
use App\Services\SpecificationService;
use App\Services\ShippingMethodService;
use App\Services\SubscriberService;
use App\Services\WeekDealService;
use App\Services\PostCategoryService;
use App\Services\PostTagService;
use App\Services\RatingService;
use App\Services\RecentlyViewedService;
use App\Services\LikeService;
use App\Services\ShopinfoService;
use App\Services\CacheService;
use App\Services\BannerService;

// Facades of initial classes
use App\Facades\AdminService as AdminServiceFacade;

use App\Facades\BreadcrumbsService as BreadcrumbsServiceFacade;
use App\Facades\MenuService as MenuServiceFacade;
use App\Facades\BrandService as BrandServiceFacade;
use App\Facades\CategoryService as CategoryServiceFacade;
use App\Facades\ProductService as ProductServiceFacade;
use App\Facades\UserAvatarService as UserAvatarServiceFacade;
use App\Facades\UserService as UserServiceFacade;
use App\Facades\CartService as CartServiceFacade;
use App\Facades\WishListService as WishListServiceFacade;
use App\Facades\OrderService as OrderServiceFacade;
use App\Facades\RelatedService as RelatedServiceFacade;
use App\Facades\ImageService as ImageServiceFacade;
use App\Facades\ImagesService as ImagesServiceFacade;
use App\Facades\OrderStatusService as OrderStatusServiceFacade;
use App\Facades\CommentService as CommentServiceFacade;
use App\Facades\AboutrecordService as AboutrecordServiceFacade;
use App\Facades\MailService as MailServiceFacade;
use App\Facades\PostService as PostServiceFacade;
use App\Facades\OptionService as OptionServiceFacade;
use App\Facades\PayMethodService as PayMethodServiceFacade;
use App\Facades\ModificationService as ModificationServiceFacade;
use App\Facades\SpecificationService as SpecificationServiceFacade;
use App\Facades\ShippingMethodService as ShippingMethodServiceFacade;
use App\Facades\SubscriberService as SubscriberServiceFacade;
use App\Facades\WeekDealService as WeekDealServiceFacade;
use App\Facades\PostCategoryService as PostCategoryServiceFacade;
use App\Facades\PostTagService as PostTagServiceFacade;
use App\Facades\RatingService as RatingServiceFacade;
use App\Facades\RecentlyViewedService as RecentlyViewedServiceFacade;
use App\Facades\LikeService as LikeServiceFacade;
use App\Facades\ShopinfoService as ShopinfoServiceFacade;
use App\Facades\CacheService as CacheServiceFacade;
use App\Facades\BannerService as BannerServiceFacade;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Facade Aliases register

        $loader = AliasLoader::getInstance();
        $loader->alias('AdminService', AdminServiceFacade::class);

        $loader->alias('BreadcrumbsService', BreadcrumbsServiceFacade::class);
        $loader->alias('MenuService', MenuServiceFacade::class);
        $loader->alias('BrandService', BrandServiceFacade::class);
        $loader->alias('CategoryService', CategoryServiceFacade::class);
        $loader->alias('ProductService', ProductServiceFacade::class);
        $loader->alias('UserAvatarService', UserAvatarServiceFacade::class);
        $loader->alias('UserService', UserServiceFacade::class);
        $loader->alias('CartService', CartServiceFacade::class);
        $loader->alias('WishListService', WishListServiceFacade::class);
        $loader->alias('OrderService', OrderServiceFacade::class);
        $loader->alias('RelatedService', RelatedServiceFacade::class);
        $loader->alias('ImageService', ImageServiceFacade::class);
        $loader->alias('ImagesService', ImagesServiceFacade::class);
        $loader->alias('OrderStatusService', OrderStatusServiceFacade::class);
        $loader->alias('CommentService', CommentServiceFacade::class);
        $loader->alias('AboutrecordService', AboutrecordServiceFacade::class);
        $loader->alias('MailService', MailServiceFacade::class);
        $loader->alias('PostService', PostServiceFacade::class);
        $loader->alias('OptionService', OptionServiceFacade::class);
        $loader->alias('PayMethodService', PayMethodServiceFacade::class);
        $loader->alias('SpecificationService', SpecificationServiceFacade::class);
        $loader->alias('ModificationService', ModificationServiceFacade::class);
        $loader->alias('ShippingMethodService', ShippingMethodServiceFacade::class);
        $loader->alias('SubscriberService', SubscriberServiceFacade::class);
        $loader->alias('WeekDealService', WeekDealServiceFacade::class);
        $loader->alias('PostCategoryService', PostCategoryServiceFacade::class);
        $loader->alias('PostTagService', PostTagServiceFacade::class);
        $loader->alias('RatingService', RatingServiceFacade::class);
        $loader->alias('RecentlyViewedService', RecentlyViewedServiceFacade::class);
        $loader->alias('LikeService', LikeServiceFacade::class);
        $loader->alias('ShopinfoService', ShopinfoServiceFacade::class);
        $loader->alias('CacheService', CacheServiceFacade::class);
        $loader->alias('BannerService', BannerServiceFacade::class);
    }

    // Providers register as singletones
    public $singletons = [
        'AdminService' => AdminService::class,

        'BreadcrumbsService' => BreadcrumbsService::class,
        'MenuService' => MenuService::class,
        'BrandService' =>BrandService::class,
        'CategoryService' => CategoryService::class,
        'ProductService' => ProductService::class,
        'UserAvatarService' => UserAvatarService::class,
        'UserService' => UserService::class,
        'CartService' => CartService::class,
        'WishListService' => WishListService::class,
        'OrderService' => OrderService::class,
        'RelatedService' => RelatedService::class,
        'ImageService' => ImageService::class,
        'ImagesService' => ImagesService::class,
        'OrderStatusService' => OrderStatusService::class,
        'CommentService' => CommentService::class,
        'AboutrecordService' => AboutrecordService::class,
        'MailService' => MailService::class,
        'PostService' => PostService::class,
        'OptionService' => OptionService::class,
        'PayMethodService' => PayMethodService::class,
        'ModificationService' => ModificationService::class,
        'SpecificationService' => SpecificationService::class,
        'ShippingMethodService' => ShippingMethodService::class,
        'SubscriberService' => SubscriberService::class,
        'WeekDealService' => WeekDealService::class,
        'PostCategoryService' => PostCategoryService::class,
        'PostTagService' => PostTagService::class,
        'RatingService' => RatingService::class,
        'RecentlyViewedService' => RecentlyViewedService::class,
        'LikeService' => LikeService::class,
        'ShopinfoService' => ShopinfoService::class,
        'CacheService' => CacheService::class,
        'BannerService' => BannerService::class,
    ];

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
