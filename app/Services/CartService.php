<?php

namespace App\Services;

use App\Facades\ModificationService;
use App\Facades\OptionService;
use App\Facades\ProductService;
use Darryldecode\Cart\Facades\CartFacade;

class CartService
{
    public function addItem($request) {
        $option = $request->option ? $request->option : null;
        $product = ProductService::getProductForCart($request->id);
        if($option) {
            $option = OptionService::getOption($request->option);
            $modification = ModificationService::getModification($product->id, $option->id);
        } else {
            $modification = null;
        }
        $qty = $request->qty ? (int)$request->qty : 1;
        $price = ProductService::getPrice($product, $modification);
        $id = isset($modification) ? $product->id .'-'. $modification->id : $product->id. '-00';

        $item = $this->addToCart($product, $qty, $option, $price, $id);
        return $item;
    }

    protected function addToCart($product, $qty, $option, $price, $id) {
        CartFacade::add(array(
            'id' => $id,
            'name' => $product['title'],
            'price' => $price,
            'quantity' => $qty,
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
        return;
    }

    public function updateCart($product_array) {
        foreach($product_array as $item) {
            CartFacade::update($item['id'], array(
                'quantity'=> array(
                    'relative' => false,
                    'value' => $item['qty'],
                ),
              ));
        }
        return;
    }

}
