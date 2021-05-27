<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Requests\AboutrecordRequest;

use App\EModels\Aboutrecord;

use App\Facades\AboutrecordService;

class AboutrecordController extends AdminController
{
    protected $model = array(
        'resource' => 'aboutrecords',
        'name' => 'Aboutrecord',
        'local_name' => 'Запись О магазине',
        'field' => 'title'
    );
    protected $img = array(
        'width' => 320,
        'height' => 320
    );

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return View('admin.'.$this->model['resource'].'.index', [
            'meta' => ['title' => 'Панель управления - Записи О магазине'],
            'aboutrecords' => Aboutrecord::latest('id')->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Allow CKFinder
        setcookie('IsAuthorized', true, time()+3600, '/');

        return View('admin.'.$this->model['resource'].'.create', [
            'meta' => ['title' => 'Панель управления - Создание записи О магазине'],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AboutrecordRequest $request, Aboutrecord $aboutrecord)
    {
        // Data validate
        $data = $request->validated();
        $item = $aboutrecord;

        // Item store
        AboutrecordService::store($item, $data, $this->model, $this->img);

        return redirect(route($this->model['resource'].'.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return View('admin.'.$this->model['resource'].'.show', [
            'meta' => ['title' => 'Панель управления - Информация записи О магазине'],
            'aboutrecord' => AboutrecordService::get_current_item($this->model['name'], $id),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Allow CKFinder
        setcookie('IsAuthorized', true, time()+3600, '/');
        return View('admin.'.$this->model['resource'].'.edit', [
            'aboutrecord' => AboutrecordService::get_current_item($this->model['name'], $id),
            'meta' => ['title' => 'Панель управления - Редактирование записи О магазине'],
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AboutrecordRequest $request, Aboutrecord $aboutrecord)
    {
        //Data validate
        $data = $request->validated();
        $item = $aboutrecord;

        // Item store
        AboutrecordService::store($item, $data, $this->model, $this->img, 'update');
        return redirect(route($this->model['resource'].'.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($ids)
    {
        // Delete items
        AboutrecordService::destroy($this->model, $ids);
        return redirect(route($this->model['resource'].'.index'));
    }
}
