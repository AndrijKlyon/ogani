<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Requests\WeekDealRequest;

use App\EModels\WeekDeal;

use App\Facades\WeekDealService;

class WeekDealController extends AdminController
{
    protected $model = array(
        'resource' => 'week_deals',
        'name' => 'WeekDeal',
        'local_name' => 'Предложение недели',
        'field' => 'product->id'
    );
    protected $img = false;


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return View('admin.'.$this->model['resource'].'.index', [
            'meta' => ['title' => 'Панель управления - Предложение недели'],
            'weekdeals' => WeekDeal::paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return View('admin.'.$this->model['resource'].'.create', [
            'meta' => ['title' => 'Панель управления - Создание предложения недели'],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(WeekDealRequest $request, WeekDeal $weekdeal)
    {
        // Data validate
        $data = $request->validated();
        // Item store
        $item = $weekdeal;
        WeekDealService::store($item, $data, $this->model, $this->img);

        return redirect(route($this->model['resource'].'.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return View('admin.'.$this->model['resource'].'.show', [
            'meta' => ['title' => 'Панель управления - Информация о предложении недели'],
            'weekdeal' => WeekDealService::get_current_item($this->model['name'], $id),
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return View('admin.'.$this->model['resource'].'.edit', [
            'weekdeal' => WeekDealService::get_current_item($this->model['name'], $id),
            'meta' => ['title' => 'Панель управления - Редактирование предложения недели'],
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(WeekDealRequest $request, $id)
    {
        //Data validate
        $data = $request->validated();

        // Item store
        $item = WeekDealService::get_current_item($this->model['name'], $id);
        WeekDealService::store($item, $data, $this->model, $this->img, 'update');

        return redirect(route($this->model['resource'].'.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($ids)
    {
        // Delete item
        WeekDealService::destroy($this->model, $ids);

        return redirect(route($this->model['resource'].'.index'));
    }
}
