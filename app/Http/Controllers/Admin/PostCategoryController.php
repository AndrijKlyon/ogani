<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Requests\PostCategoryRequest;

use App\EModels\PostCategory;

use App\Facades\PostCategoryService;

class PostCategoryController extends AdminController
{
    protected $model = array(
        'resource' => 'post_categories',
        'name' => 'PostCategory',
        'local_name' => 'Категория постов',
        'field' => 'title'
    );
    protected $img = false;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return View('admin.'.$this->model['resource'].'.index', [
            'meta' => ['title' => 'Панель управления - Категории постов'],
            'categories' => PostCategory::latest('id')->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View('admin.'.$this->model['resource'].'.create', [
            'meta' => ['title' => 'Панель управления - Создание категории постов'],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostCategoryRequest $request, PostCategory $postcategory)
    {
        // Data validate
        $data = $request->validated();
        $item = $postcategory;

        // Item store
        PostCategoryService::store($item, $data, $this->model, $this->img);

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
            'meta' => ['title' => 'Панель управления - Информация о категории постов'],
            'category' => PostCategoryService::get_current_item($this->model['name'], $id),
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
        return View('admin.'.$this->model['resource'].'.edit', [
            'category' => PostCategoryService::get_current_item($this->model['name'], $id),
            'meta' => ['title' => 'Панель управления - Редактирование категории постов'],
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostCategoryRequest $request, $id)
    {
         //Data validate
         $data = $request->validated();
         $item = PostCategoryService::get_current_item($this->model['name'], $id);

         // Item store
         PostCategoryService::store($item, $data, $this->model, $this->img, 'update');
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
        PostCategoryService::destroy($this->model, $ids, true);
        return redirect(route($this->model['resource'].'.index'));
    }
}
