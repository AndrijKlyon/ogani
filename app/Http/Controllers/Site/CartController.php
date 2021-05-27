<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Site\SiteController;
use Illuminate\Http\Request;

use App\EModels\ShippingMethod;

use App\Facades\CartService;
use Darryldecode\Cart\Facades\CartFacade;

class CartController extends SiteController
{
    public function add(Request $request) {
        CartService::addItem($request);
        if($request->ajax()){
            return $this->show();
        }
        redirect();
    }


    public function show() {
        return View('site.cart.modal', [
            'cart_products' => CartFacade::getContent(),
            'total_quantity' => CartFacade::getTotalQuantity(),
            'total_sum' => CartFacade:: getSubTotal(),
        ]);
    }

    public function delete(Request $request) {
        $id = $request->has('id') ? $request->id : null;
        CartFacade::remove($id);
        if($request->ajax()){
            return $this->show();
        }
        redirect();
    }

    public function clear() {
        CartFacade::clear();
        return $this->show();
    }

    public function view() {
        $meta = [
            'title' => config('template_settings.site.title') . ' - Корзина',
            'keywords' => 'корзина',
            'description' => 'корзина',
        ];
        return View('site.cart.index', [
            'meta' => $meta,
            'cart_products' => CartFacade::getContent(),
            'total_quantity' => CartFacade::getTotalQuantity(),
            'total_sum' => CartFacade:: getSubTotal(),
            'shippings' => ShippingMethod::all(),
            'breadcrumb_title' => 'Корзина'
        ]);
    }

    public function recalculate(Request $request) {
        if(CartFacade::getTotalQuantity()<1) {
            return back()
            ->withErrors(['billing' => 'В Вашей корзине нет товаров'])
            ->withInput();
        }
        CartService::updateCart($request->products_array);
        return;
    }

}
