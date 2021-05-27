<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;
use App\EModels\Order;
use App\EModels\OrderProduct;
use App\Facades\OrderService;
use Illuminate\Http\Request;

class OrderController extends AdminController
{
    protected $model = array(
        'resource' => 'orders',
        'name' => 'Order',
        'local_name' => 'Заказ',
        'field' => 'id'
    );
    protected $img = false;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return View('admin.'.$this->model['resource'].'.index', [
            'orders' => Order::with('status')
                        ->with('user')
                        ->latest('id')
                        ->paginate(10),
            'meta' => ['title' => 'Панель управления - Заказы']
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        return View('admin.'.$this->model['resource'].'.show', [
            'order' => $order,
            'meta' => ['title' => 'Панель управления - Заказ #' . $order['id']],
            'order_products' => OrderProduct::where('order_id', $order->id)->get(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Order $order)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        OrderService::updateStatus($request, $order);
        return redirect(route('orders.show', ['order' => $order->id]));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($ids)
    {
        OrderService::destroy($this->model, $ids);
        return redirect(route($this->model['resource'].'.index'));
    }

}
