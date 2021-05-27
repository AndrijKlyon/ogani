<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Requests\BrandRequest;

use App\EModels\Brand;
use App\Facades\BrandService;

class BrandController extends AdminController
{
    protected $model = array(
        'resource' => 'brands',
        'name' => 'Brand',
        'local_name' => 'Бренд',
        'field' => 'title'
    );
    protected $img = array(
        'width' => 120,
        'height' => 70
    );

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return View('admin.'.$this->model['resource'].'.index', [
            'meta' => ['title' => 'Панель управления - Бренды'],
            'brands' => Brand::latest('id')->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return View('admin.'.$this->model['resource'].'.create', [
            'meta' => ['title' => 'Панель управления - Создание бренда'],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BrandRequest $request, Brand $brand)
    {
        // Data validate
        $data = $request->validated();
        $item = $brand;

        // Item store
        BrandService::store($item, $data, $this->model, $this->img);
        return redirect(route($this->model['resource'].'.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return View('admin.'.$this->model['resource'].'.show', [
            'meta' => ['title' => 'Панель управления - Информация о бренде'],
            'brand' => BrandService::get_current_item($this->model['name'], $id),
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return View('admin.'.$this->model['resource'].'.edit', [
            'brand' => BrandService::get_current_item($this->model['name'], $id),
            'meta' => ['title' => 'Панель управления - Редактирование бренда'],
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BrandRequest $request, Brand $brand)
    {
        //Data validate
        $data = $request->validated();
        $item = $brand;

        // Item store
        BrandService::store($item, $data, $this->model, $this->img, 'update');
        return redirect(route($this->model['resource'].'.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($ids)
    {
        BrandService::destroy($this->model, $ids, true);
        return redirect(route($this->model['resource'].'.index'));
    }
}
