<?php

namespace App\Services;

use App\EModels\Option;
use App\EModels\Product;
use App\Facades\ModificationService;
use App\Facades\ProductService;

class WishListService {

    public function add($request) {
        $id = $request->id ? (int)$request->id : '';
        $option = $request->option ? $request->option : null;

        $product = Product::where('id', $id)->with('category')->first();
        if($option) {
            $option = Option::where('title', $option)->firstOrFail();
            $modification = ModificationService::getModification($product->id, $option->id);
        } else {
            $modification = null;
        }
        $id = isset($modification) ? $product->id .'-'. $modification->id : $product->id. '-00';
        $price = ProductService::getPrice($product, $modification);
        $this->addItem($id, $option, $product, $price);

    }

    protected function addItem($id, $option, $product, $price) {
        $wish_list = app('wishlist');
        $wish_list -> add(array(
            'id' => $id,
            'name' => $product['title'],
            'price' => $price,
            'quantity' => 1,
            'attributes' => array(
                'alias' => $product['alias'],
                'product_id' => $product->id,
                'option' => $option != null ? $option->title : $option,
                'img' => $product->first_image,
                'category' => $product['category']['alias'],
                'parent_category' => $product['parent_category_alias'],
                )
            )
        );
    }

}
