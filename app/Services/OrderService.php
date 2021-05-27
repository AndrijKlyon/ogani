<?php

namespace App\Services;

use App\EModels\Order;
use App\EModels\OrderProduct;
use Darryldecode\Cart\Facades\CartFacade;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;


class OrderService extends AdminService {

    // site
    public function getUserOrders($user_id) {
    return Order::where('user_id', $user_id)->with('products','status')
                ->latest('id')->get();
    }


    // admin

    public function create($data, $user) {
        $data['user_id'] =  $user->id;
        $data['status_id'] =  1;
        $data['amount'] = CartFacade:: getSubTotal();
        $order = Order::create($data);
        $order->save();
        return $order;
    }

    public function updateStatus($request, $order) {
        $order_status = $request['orderstatus_new'] ? $request['orderstatus_new'] : null;
        $pay_status = $request['paystatus_new'] ? $request['paystatus_new'] : null;
        if($order_status || $pay_status) {
            if($order_status) $order->status_id = $order_status;
            if($pay_status) $order->pay_status = $pay_status == 'no' ? '0' : '1';
            $order->updated_at = Carbon::now();
            $order->save();
            $message = 'Заказ #' . $order->id . ': статус успешно изменен.';
            Session::flash('message', $message);
            Session::flash('alert-class', 'alert-success');
        }
        return;
    }

    public function formOrder($order) {
        $order_products = Array();
        $order_products_table = Array();
        foreach(CartFacade::getContent() as $item) {
            array_push($order_products, $item);
            array_push($order_products_table,
            [
                'order_id' => $order->id,
                'qty' =>  $item->quantity,
                'title' => $item->name,
                'price' => $item->price,
                'product_id' => $item->attributes['product_id'],
                'option' => $item->attributes['option']
            ]);
        }
        OrderProduct::insert($order_products_table);
        CartFacade::clear();
        return $order_products;
    }

}
