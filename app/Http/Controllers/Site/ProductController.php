<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Site\SiteController;
use Illuminate\Http\Request;

use App\Facades\BreadcrumbsService;
use App\Facades\CategoryService;
use App\Facades\ProductService;
use App\Facades\OptionService;
use App\Facades\RelatedService;

class ProductController extends SiteController
{

    public function show(Request $request, $alias) {
        $product = ProductService::getProduct($alias);
        $breadcrumbs_array = BreadcrumbsService::getBreadcrumbs(CategoryService::getCategories(), $product->category_id);
        views($product)->record();
        return view('site.product.index', [
            'product' => $product,
            'meta' => [
                'title' => $product->title,
                'keywords' => $product->keywords,
                'description' => $product->description,
            ],
            'breadcrumbs_array' => $breadcrumbs_array,
            'related_products' => RelatedService::getRelatedProductsByProduct($product),
            'recently_products' => ProductService::getRecentlyViewedProducts($product)
        ]);
    }

    public function index(Request $request) {
        $perpage = $request->query('pp') ? $request->query('pp') : 6;
        // Get breadcrumbs and all categories of parent category
        $parentcat_alias = null; $cat_alias = null;
        if(isset($request->query('filter')['category.alias'])) {
            $categories =  CategoryService::getCategories();
            $category = $categories->where('alias', $request->query('filter')['category.alias'])->first();
            $breadcrumbs_array = BreadcrumbsService::getBreadcrumbs(CategoryService::getCategories(), $category['id']);
            $cat_alias = $request->query('filter')['category.alias'];
            $parentcat_alias =  CategoryService::addChildCategories($request, $categories, $category);
        }
        // Get products
        $products = ProductService::getProducts($perpage);
        // Put filters and sorting
        ProductService::putProductsFilters($products, $request, $perpage, $parentcat_alias, $cat_alias);

        return view('site.products.index', [
            'meta' => [
                'title' => config('template_settings.site.title') . ' - Каталог',
                'keywords' => config('template_settings.site.keywords'),
                'description' => config('template_settings.site.description'),
            ],
            'products' => $products,
            'options' => OptionService::getOptions(),
            'breadcrumb_title' => 'Каталог',
            'latest_products' => ProductService::getLatestProducts(),
            'offer_products' => ProductService::getOfferProducts(),
            'breadcrumbs_array' => isset($breadcrumbs_array) ? $breadcrumbs_array : null,
        ]);
    }

}
