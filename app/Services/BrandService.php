<?php

namespace App\Services;

use App\EModels\Product;
use App\Facades\CacheService;

class BrandService extends AdminService {


    // site
    public function getBrands() {
        return CacheService::getFromCache('Brand', 'brands');
    }

    //admin
    public function checkDestroyBrand($item, $model) {
        $result = array(
            'type' => 'success',
        );
        // Check, if products has this brand
        $products = Product::where('brand_id', $item->id)->get();
        if ($products->isNotEmpty()) {
            $result = array(
                'type' => 'error',
                'message' => 'Удаление невозможно. Следующие товары привязаны к бренду: ' . $products->pluck('id')->implode(', ')
            );
        }
        return $result;
    }

}
