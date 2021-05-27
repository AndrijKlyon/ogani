<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Site\SiteController;
use Illuminate\Http\Request;

use App\Facades\WishListService;

class WishListController extends SiteController
{
    public function add(Request $request) {

        WishListService::add($request);

        if($request->ajax()){
            return $this->show();
        }
        redirect();
    }

    public function show() {
        $wish_list = app('wishlist');
        return View('site.wishlist.modal', [
            'wishlist_products' => $wish_list -> getContent(),
            'wishlist_quantity' => $wish_list -> getTotalQuantity(),
        ]);
    }

    public function delete(Request $request) {
        $wish_list = app('wishlist');
        $id = $request->id ? $request->id : null;
        $wish_list -> remove($id);
        if($request->ajax()){
            return $this->show();
        }
        redirect();
    }

    public function clear() {
        $wish_list = app('wishlist');
        $wish_list -> clear();
        return $this->show();
    }

    public function view() {
        $meta = [
            'title' => config('template_settings.site.title') . ' - Список пожеланий',
            'keywords' => 'список пожеланий',
            'description' => 'список пожеланий',
        ];
        $wish_list = app('wishlist');
        return View('site.wishlist.index', [
            'meta' => $meta,
            'wishlist_products' => $wish_list -> getContent(),
            'breadcrumb_title' => 'Список пожеланий'
        ]);
    }
}
