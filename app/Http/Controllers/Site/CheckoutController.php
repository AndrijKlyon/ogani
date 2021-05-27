<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Site\SiteController;
use App\Http\Requests\CheckoutRequest;


use App\EModels\PayMethod;
use App\EModels\ShippingMethod;

use App\Facades\OrderService;
use App\Facades\UserService;
use Darryldecode\Cart\Facades\CartFacade;
use Illuminate\Support\Facades\Session;

class CheckoutController extends SiteController
{
    public function index() {
        $pay_methods = '';
        $shipping_methods = '';
        $meta = [
            'title' => config('template_settings.site.title') . ' - Оформление заказа',
            'keywords' => 'оформление заказа',
            'description' => 'оформление заказа',
        ];
        if(!CartFacade::isEmpty()) {
            $pay_methods = PayMethod::all();
            $shipping_methods = ShippingMethod::all();
        }
        return View('site.checkout.index', [
            'meta' => $meta,
            'cart_products' => CartFacade::getContent(),
            'total_quantity' => CartFacade::getTotalQuantity(),
            'total_sum' => CartFacade:: getSubTotal(),
            'shipping_methods' => $shipping_methods,
            'pay_methods' => $pay_methods,
            'breadcrumb_title' => 'Оформление заказа'
        ]);

    }

    public function finish(CheckoutRequest $request) {
        if(!CartFacade::isEmpty()) {
            $data = $request->validated();
            // User update
            $user = UserService::profile_update($data);
            // Order create
            $order = OrderService::create($data, $user);
            // Order products forming
            $order_products = OrderService::formOrder($order);
            // Get full info about shipping
            $shipping = ShippingMethod::where('title', $data['shipping_method'])->first();
            // Set flash info about order
            Session::flash('message', 'Checkout finish');
        }
        return View('site.checkout.send_order', [
            'meta' => [
                'title' => config('template_settings.site.title') . ' - Статус заказа',
                'keywords' => 'статус заказа',
                'description' => 'статус заказа',
            ],
            'breadcrumb_title' => 'Статус заказа',
            'order_products' => isset($order_products) ? $order_products : null,
            'order' =>  isset($order) ? $order : null,
            'data' => isset($data) ? $data : null,
            'shipping' => isset($shipping) ? $shipping : null,
        ]);
    }


}

