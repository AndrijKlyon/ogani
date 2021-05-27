<?php

namespace App\Services;

use App\EModels\RelatedProduct;
use App\Facades\ProductService;

class RelatedService extends AdminService {

    public function getRelatedProducts($query) {

        $data['items'] = [];
        $products = ProductService::getLivesearchedProducts($query);
        if(count($products)>0) {
            $i = 0;
            foreach($products as $product) {
                $data['items'][$i]['id'] = $product['id'];
                $data['items'][$i]['text'] = $product['title'];
                $i++;
            }
        }
        return $data;
    }

    public function getRelatedProductsByProduct($product) {
        return $product->related()->with('images')->get();
    }

    public function getRelated($data, $id, $related_name, $item_name) {
        if(isset($data) && !empty($data)) {
            $related = array_unique($data);
            if(!empty($related)) {
                $related_array = array();
                foreach($related as $item) {
                    array_push($related_array, [$item_name => $id,
                                                $related_name => $item,
                                                ]);
                }
            }
        }
        return isset($related_array) ? $related_array : null;
    }

    public function relatedProduct_check($product) {
        $products = RelatedProduct::where('related_id', $product->id)
        ->join('products', 'related_products.product_id', 'products.id')->get();

        if($products->isNotEmpty()) {
            $message = "";
            foreach($products as $item) {
                $message = $message . $item['title'] . ', ';
            }
            $message = "Товар '" .$product->title. "': удаление невозможно. Есть связанные товары: " . substr($message, 0, -2);
            return $message;
        } else {
            return null;
        }
    }

    public function storeRelated($data, $id, $related_name, $item_name, $related_model) {
        $related = $this->getRelated($data, $id, $related_name, $item_name);
        if ($related != null && !empty($related)) {
            app("App\\EModels\\".$related_model)->insert($related);
        }
        return;
    }


    public function updateRelated($data, $id, $related_name, $item_name, $related_model) {

        $related = $this->getRelated($data, $id, $related_name, $item_name);
        $product_related = app("App\\EModels\\".$related_model)->where($item_name, $id)->get()->toArray();

        // New related was added - insert it to DB
        if (empty($product_related) && $related != null && !empty($related)) {
            app("App\\EModels\\".$related_model)->insert($related);
        }
        // Exists related was deleted - delete it from DB
        if ((empty($related) || $related == null) && !empty($product_related)) {
            app("App\\EModels\\".$related_model)->where($item_name, $id)->delete();
        }
         // Related was changed - delete old values and store new values
         if (!empty($related)) {
            $result = strcmp(json_encode($product_related), json_encode($related));
            if (!empty($result) || count($product_related) != count($related)) {
                //delete old values
                app("App\\EModels\\".$related_model)->where($item_name, $id)->delete();
                // store new values
                app("App\\EModels\\".$related_model)->insert($related);
            }
        }
        return;
    }




}
