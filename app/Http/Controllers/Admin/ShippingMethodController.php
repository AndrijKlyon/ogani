<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Requests\ShippingMethodRequest;

use App\EModels\ShippingMethod;

use App\Facades\ShippingMethodService;

class ShippingMethodController extends AdminController
{
    protected $model = array(
        'resource' => 'shipping_methods',
        'name' => 'ShippingMethod',
        'local_name' => 'Способ доставки',
        'field' => 'title'
    );
    protected $img = false;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return View('admin.'.$this->model['resource'].'.index', [
            'meta' => ['title' => 'Панель управления - Способы доставки'],
            'shippings' => ShippingMethod::latest('id')->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return View('admin.'.$this->model['resource'].'.create', [
            'meta' => ['title' => 'Панель управления - Создание способа доставки'],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ShippingMethodRequest $request, ShippingMethod $shipping)
    {
        // Data validate
        $data = $request->validated();
        // Item store
        $item = $shipping;
        ShippingMethodService::store($item, $data, $this->model, $this->img);

        return redirect(route($this->model['resource'].'.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return View('admin.'.$this->model['resource'].'.show', [
            'meta' => ['title' => 'Панель управления - Информация о способе доставки'],
            'shipping' => ShippingMethodService::get_current_item($this->model['name'], $id),
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return View('admin.'.$this->model['resource'].'.edit', [
            'shipping' => ShippingMethodService::get_current_item($this->model['name'], $id),
            'meta' => ['title' => 'Панель управления - Редактирование способа доставки'],
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ShippingMethodRequest $request, $id)
    {
        //Data validate
        $data = $request->validated();
        // Item store
        $item = ShippingMethodService::get_current_item($this->model['name'], $id);
        ShippingMethodService::store($item, $data, $this->model, $this->img, 'update');
        return redirect(route($this->model['resource'].'.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($ids)
    {
        // Delete items
        ShippingMethodService::destroy($this->model, $ids);
        return redirect(route($this->model['resource'].'.index'));
    }
}

