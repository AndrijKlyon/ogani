<?php

namespace App\Services;

use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;

use App\EModels\Product;
use App\EModels\ProductImage;
use App\EModels\Rating;
use App\Facades\CategoryService;
use Laracasts\Utilities\JavaScript\JavaScriptFacade;
use App\Facades\ImageService;
use App\Facades\ImagesService;
use App\Facades\ModificationService;
use App\Facades\RelatedService;
use App\Facades\SpecificationService;
use App\Facades\RecentlyViewedService;

class ProductService extends AdminService {

    //site
    public function getOfferProducts() {
        return Product::where('special_price', '!=', null)
                        ->latest('id')
                        ->limit(12)
                        ->with('images', 'category')
                        ->get();
    }

    public function getFeaturedProducts() {
        return Product::where('hit', '1')
                        ->latest('id')
                        ->limit(12)
                        ->with('images', 'category')
                        ->get();
    }

    public function getPopularProducts() {
        return Product::orderByViews()
                        ->with('images')
                        ->limit(12)
                        ->get();
    }

    public function getWeekDealProduct($weekdeal) {
        if($weekdeal) {
            return Product::where('id', $weekdeal->product_id)
                            ->with('images')
                            ->first();
        }
        return null;
    }

    public function getLatestProducts() {
        return Product::latest('id')
                        ->limit(12)
                        ->with('images')
                        ->get();
    }

    public function getProduct($alias) {
        return Product::where('alias', $alias)
                        ->with('category', 'specifications', 'images', 'modifications', 'options')
                        ->firstOrFail();
    }

    public function getProductForCart($id) {
        $product = Product::where('id', $id)->with('category')->firstOrFail();
        return CategoryService::addParentCategory($product);
    }

    public function getNextProduct($product) {
        return Product::where('category_id', $product->category_id)
                        ->where('id', '>', $product->id)
                        ->orderBy('id')
                        ->first();
    }

    public function getPrevProduct($product) {
        return Product::where('category_id', $product->category_id)
                        ->where('id', '<', $product->id)
                        ->orderBy('id', 'desc')
                        ->first();
    }

    public function getRecentlyViewedProducts($product) {
        $ids = RecentlyViewedService::recently($product);
        if($ids != null) {
            return Product::whereIn('id', $ids)->with('images')->get();
        }
        return false;
    }

    public function getProducts($perpage) {
        return QueryBuilder::for(Product::class)
        ->with('category', 'images')
        ->where('status', '1')
        ->allowedFilters(
            'title',
            'id',
            AllowedFilter::exact('category.alias'),
            AllowedFilter::exact('options.alias'),
            AllowedFilter::scope('price_between')
            )
        ->allowedSorts('price', 'title', 'id')
        ->latest('id')
        ->jsonPaginate($perpage);
    }

    public function getPrice($product, $modification) {
        if(isset($modification) && $modification->modification_price != null) {
            $price = $modification->modification_price;
        }
        else {
            $price = $product->special_price != 0 ? $product->special_price : $product->price;
        }
        return $price;
    }

    public function putProductsFilters($products, $request, $perpage, $parentcat_alias, $cat_alias) {
        JavaScriptFacade::put([
            'product_count' => $products->total(),
            'paginate_pages' => $products->lastPage(),
            'pp' => $perpage,
            'sort' => $request->query('sort') ? $request->query('sort') : null,
            'filters' => $request->query('filter') ? $request->query('filter') : null,
            'cat_alias' => isset($cat_alias) ? $cat_alias : null,
            'parentcat_alias' => isset($parentcat_alias) ? $parentcat_alias : null
            ]);
    }

    public function getLivesearchedProducts($query, $cat_ids) {
        return Product::where([
            ['status', '=', '1'],
            ['title', 'like', '%'.$query.'%']
            ])
            ->whereIn('category_id', $cat_ids)
            ->with('images')
            ->limit(8)->get();
    }

    public function getAllSearchedProduct($query) {
        return Product::where([
            ['status', '=', '1'],
            ['title', 'like', '%'.$query.'%']
            ])->with('category')->paginate(10);
    }

    public function getSearchedProducts($query) {
        return Product::where([
            ['status', '=', '1'],
            ['title', 'like', '%'.$query.'%']
            ])->paginate(6);
    }

    //admin

    public function actionsStoreProduct($item, $data, $model, $mode, $imgs) {

        // Product store
        $id = $this->store_item($item, $model, $data, $mode);

        if($mode == 'save') {
            // Product images store
            ImagesService::storeImages($data, $model, $imgs, $id);
            // Modifications store
            ModificationService::storeModifications($data, $id);
            // Related products store
            RelatedService::storeRelated($data['related'], $id, 'related_id', 'product_id', 'RelatedProduct');
            // Specifications store
            SpecificationService::storeSpecifications($data, $id);
        }
        if($mode == 'update') {
            // Modifications update
            ModificationService::updateModifications($data, $id);
            // Related products update
            RelatedService::updateRelated($data['related'], $id, 'related_id', 'product_id', 'RelatedProduct');
            // Specifications update
            SpecificationService::updateSpecifications($data, $id);
            // Product images update
            ImagesService::updateImages($data, $model, $imgs, $id);

        }
        return 'finish';
    }

    public function checkDestroyProduct($item, $model) {
        $result = RelatedService::relatedProduct_check($item);
        if($result) {
            $message = array(
                'type' => 'error',
                'message' => $result
            );
        }
        else {
            $message = array(
                'type' => 'success',
            );
        }
        return $message;
    }

    public function actionsDestroyProduct($item, $model) {
        $product_images = ProductImage::where('product_id', $item->id)->get();
        if($product_images->isNotEmpty()) {
            foreach($product_images as $item) {
                ImageService::deleteImage($item['img'], 'products');
                ImageService::deleteImageVariations($item['img'], 'thumbs/products', ['110x110', '300x300']);
            }
        }
        Rating::where(['rateable_type' => 'App\EModels\Product', 'rateable_id' => $item->id])->delete();
    }


}
