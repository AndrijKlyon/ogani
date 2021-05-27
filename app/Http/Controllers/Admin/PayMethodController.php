<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Requests\PayMethodRequest;

use App\EModels\PayMethod;

use App\Facades\PayMethodService;

class PayMethodController extends AdminController
{
    protected $model = array(
        'resource' => 'pay_methods',
        'name' => 'PayMethod',
        'local_name' => 'Способ оплаты',
        'field' => 'title'
    );
    protected $img = false;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return View('admin.'.$this->model['resource'].'.index', [
            'meta' => ['title' => 'Панель управления - Способы оплаты'],
            'paymethods' => PayMethod::latest('id')->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return View('admin.'.$this->model['resource'].'.create', [
            'meta' => ['title' => 'Панель управления - Создание Способа оплаты'],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PayMethodRequest $request, PayMethod $paymethod)
    {
        // Data validate
        $data = $request->validated();
        // Item store
        $item = $paymethod;
        PayMethodService::store($item, $data, $this->model, $this->img);

        return redirect(route($this->model['resource'].'.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return View('admin.'.$this->model['resource'].'.show', [
            'meta' => ['title' => 'Панель управления - Информация о Способе оплаты'],
            'paymethod' => PayMethodService::get_current_item($this->model['name'], $id),
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return View('admin.'.$this->model['resource'].'.edit', [
            'paymethod' => PayMethodService::get_current_item($this->model['name'], $id),
            'meta' => ['title' => 'Панель управления - Редактирование Способа оплаты'],
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PayMethodRequest $request, PayMethod $paymethod)
    {
        //Data validate
        $data = $request->validated();
        $item = $paymethod;

        // Item store
        PayMethodService::store($item, $data, $this->model, $this->img, 'update');
        return redirect(route($this->model['resource'].'.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($ids)
    {
        // Delete items
        PayMethodService::destroy($this->model, $ids);
        return redirect(route($this->model['resource'].'.index'));
    }
}

