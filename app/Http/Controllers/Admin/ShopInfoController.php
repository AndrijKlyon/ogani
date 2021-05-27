<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Requests\ShopinfoRequest;

use App\EModels\Shopinfo;

use App\Facades\ShopinfoService;

class ShopInfoController extends AdminController
{
    protected $model = array(
        'resource' => 'shopinfos',
        'name' => 'Shopinfo',
        'local_name' => 'Справочная статья',
        'field' => 'title'
    );
    protected $img = array(
        'width' => 750,
        'height' => 400
    );

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return View('admin.'.$this->model['resource'].'.index', [
            'meta' => ['title' => 'Панель управления - Справочные статьи'],
            'shopinfos' => Shopinfo::latest('id')->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Allow CKFinder
        setcookie('IsAuthorized', true, time()+3600, '/');

        return View('admin.'.$this->model['resource'].'.create', [
            'meta' => ['title' => 'Панель управления - Создание справочной статьи'],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ShopinfoRequest $request, Shopinfo $shopinfo)
    {
        // Data validate
        $data = $request->validated();
        $item = $shopinfo;

        // Item store
        ShopinfoService::store($item, $data, $this->model, $this->img);

        return redirect(route($this->model['resource'].'.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return View('admin.'.$this->model['resource'].'.show', [
            'meta' => ['title' => 'Панель управления - Информация о справочной статье'],
            'shopinfo' => ShopinfoService::get_current_item($this->model['name'], $id),
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Allow CKFinder
        setcookie('IsAuthorized', true, time()+3600, '/');

        return View('admin.'.$this->model['resource'].'.edit', [
            'shopinfo' => ShopinfoService::get_current_item($this->model['name'], $id),
            'meta' => ['title' => 'Панель управления - Редактирование справочной статьи'],
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ShopinfoRequest $request, Shopinfo $shopinfo)
    {
        //Data validate
        $data = $request->validated();
        $item = $shopinfo;

        // Item store
        ShopinfoService::store($item, $data, $this->model, $this->img, 'update');

        return redirect(route($this->model['resource'].'.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($ids)
    {
        // Delete item
        ShopinfoService::destroy($this->model, $ids);

        return redirect(route($this->model['resource'].'.index'));

    }

}

