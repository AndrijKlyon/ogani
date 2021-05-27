<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\OrderStatusRequest;
use App\Http\Controllers\Admin\AdminController;
use Illuminate\Http\Request;

use App\EModels\OrderStatus;

use App\Facades\OrderStatusService;

class OrderStatusController extends AdminController {

    protected $model = array(
        'resource' => 'order_statuses',
        'name' => 'OrderStatus',
        'local_name' => 'Статус заказа',
        'field' => 'title'
    );
    protected $img = false;

     /**
     * Display a listing of the resource.
     */
    public function index(Request $request) {

        if($request->ajax()) {
            $statuses = OrderStatus::all();
            $resulthtml = '';
            foreach($statuses as $item) {
                $resulthtml .= '<option value="' . $item->id . '">' . $item->title . '</option>';
            }
            return $resulthtml;
        }

        return View('admin.'.$this->model['resource'].'.index', [
            'meta' => ['title' => 'Панель управления - Статусы заказа'],
            'order_statuses' => OrderStatus::latest('id')->paginate(10),
        ]);
    }

     /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return View('admin.'.$this->model['resource'].'.create', [
            'meta' => ['title' => 'Панель управления - Создание Статуса заказа'],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OrderStatusRequest $request, OrderStatus $orderstatus)
    {
        // Data validate
        $data = $request->validated();
        // Item store
        $item = $orderstatus;
        OrderStatusService::store($item, $data, $this->model, $this->img);

        return redirect(route($this->model['resource'].'.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return View('admin.'.$this->model['resource'].'.show', [
            'meta' => ['title' => 'Панель управления - Информация о Статусе заказа'],
            'order_status' => OrderStatusService::get_current_item($this->model['name'], $id),
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return View('admin.'.$this->model['resource'].'.edit', [
            'order_status' => OrderStatusService::get_current_item($this->model['name'], $id),
            'meta' => ['title' => 'Панель управления - Редактирование Статуса заказа'],
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(OrderStatusRequest $request, $id)
    {
        //Data validate
        $data = $request->validated();
        // Item store
        $item = OrderStatusService::get_current_item($this->model['name'], $id);

        OrderStatusService::store($item, $data, $this->model, $this->img, 'update');
        return redirect(route($this->model['resource'].'.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($ids)
    {
       // Delete items
        OrderStatusService::destroy($this->model, $ids);
        return redirect(route($this->model['resource'].'.index'));
    }

}
