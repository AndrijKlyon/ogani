<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Requests\OptionRequest;

use App\EModels\Option;

use App\Facades\OptionService;

class OptionController extends AdminController
{
    protected $model = array(
        'resource' => 'options',
        'name' => 'Option',
        'local_name' => 'Значение опции',
        'field' => 'title'
    );
    protected $img = array(
        'width' => 100,
        'height' => 100
    );

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return View('admin.'.$this->model['resource'].'.index', [
            'meta' => ['title' => 'Панель управления - Опция'],
            'options' => Option::latest('id')->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return View('admin.'.$this->model['resource'].'.create', [
            'meta' => ['title' => 'Панель управления - Создание значения опции 1'],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OptionRequest $request, Option $option)
    {
        // Data validate
        $data = $request->validated();
        $item = $option;

        // Item store
        OptionService::store($item, $data, $this->model, $this->img);

        return redirect(route($this->model['resource'].'.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return View('admin.'.$this->model['resource'].'.show', [
            'meta' => ['title' => 'Панель управления - Информация о значении Опции'],
            'option' => OptionService::get_current_item($this->model['name'], $id),
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return View('admin.'.$this->model['resource'].'.edit', [
            'option' => OptionService::get_current_item($this->model['name'], $id),
            'meta' => ['title' => 'Панель управления - Редактирование значения Опции'],
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(OptionRequest $request, $id)
    {
        //Data validate
        $data = $request->validated();
        $item = OptionService::get_current_item($this->model['name'], $id);

        // Item store
        OptionService::store($item, $data, $this->model, $this->img, 'update');
        return redirect(route($this->model['resource'].'.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($ids)
    {
        // Delete items
        OptionService::destroy($this->model, $ids, true);
        return redirect(route($this->model['resource'].'.index'));
    }
}
