<?php

namespace App\Services;

use App\EModels\Category;
use App\EModels\Product;
use Illuminate\Support\Facades\Cache;

class CategoryService extends AdminService {

    // site
    public function getCategories() {
        $items = Cache::get('categories');
        if(!$items) {
            $items = Category::withCount('products')->get();
            Cache::put('categories', $items, 3600);
        }
        return $items;
    }

    public function getFeaturedCategories() {
        return $this->getCategories()->where('hit', '1')->sortByDesc('id')->take(4);
    }

    public function addParentCategories($products) {
        foreach($products as $item) {
           $this->addParentCategory($item);
        }
        return $products;
    }

    public function addParentCategory($product) {
        $categories = $this->getCategories();
        $parent_category = $this->getParentCategory($product->category);
        $product['parent_category'] = $parent_category['title'];
        $product['parent_category_alias'] = $parent_category['alias'];
        return $product;
    }

    public function getParentCategory($category) {
        $categories = $this->getCategories();
        if($category['parent_id'] == 0) return $category;
        $category = $categories->where('id', $category['parent_id'])->first();
        return $this->getParentCategory($category);
    }

    public function getChildren($category) {
        $ids = array();
        foreach($this->getCategories() as $item) {
            if($category == 'all') {
                array_push($ids, $item->id);
            }
            else {
                if($item->id == $category || $item->parent_id == $category) {
                    array_push($ids, $item->id);
                }
            }
        }
        return $ids;
    }

    public function addChildCategories($request, $categories, $category) {
        $filters = [];
            foreach($request->input('filter') as $key => $value) {
                if($key == 'category.alias') {
                    if($category && $category['parent_id'] == 0) {
                        $value = $categories->where('parent_id', $category['id'])->implode('alias', ',');
                        $parentcat_alias = $this->getParentCategory($category)['alias'];
                    }
                }
            $filters[$key] = $value;
            }
            $request->request->add([
                'filter' => $filters
            ]);
            return isset($parentcat_alias) ? $parentcat_alias : null;
    }

    // admin
    public function checkDestroy($item) {
        $result = array(
            'type' => 'success',
        );
        // Check, if category has children categories
        $children = Category::where('parent_id', $item->id)->first();
        if ($children != null) {
            $result = array(
                'type' => 'error',
                'message' => 'Удаление невозможно: категория "'.$item->title.'" содержит дочерние категории.'
            );
        }
        // Check, if category has products
        $products = Product::where('category_id', $item->id)->first();
        if ($products) {
            $result = array(
                'type' => 'error',
                'message' => 'Удаление невозможно: категория "'.$item->title.'" содержит товары.'
            );
        }
        return $result;
    }

    public function checkDestroyCategory($item, $model) {
        return $this->checkDestroy($item);
    }

}
