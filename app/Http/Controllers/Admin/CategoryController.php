<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Requests\CategoryRequest;

use App\EModels\Category;

use App\Facades\CategoryService;

class CategoryController extends AdminController
{
    protected $model = array(
        'resource' => 'categories',
        'name' => 'Category',
        'local_name' => 'Категория',
        'field' => 'title'
    );
    protected $img = array(
        'width' => 450,
        'height' => 450
    );

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return View('admin.'.$this->model['resource'].'.index', [
            'meta' => ['title' => 'Панель управления - Категории'],
            'categories' => Category::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return View('admin.'.$this->model['resource'].'.create', [
            'meta' => ['title' => 'Панель управления - Создание категории'],
            'categories' => Category::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request, Category $category)
    {
        // Data validate
        $data = $request->validated();
        $item = $category;

        // Item store
        CategoryService::store($item, $data, $this->model, $this->img);

        return redirect(route($this->model['resource'].'.index'));
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $category = CategoryService::get_current_item($this->model['name'], $id);
        return View('admin.'.$this->model['resource'].'.show', [
            'meta' => ['title' => 'Панель управления - Просмотр категории'],
            'category' => $category,
            'parent_category' => CategoryService::get_current_item($this->model['name'], $category['parent_id']),
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return View('admin.'.$this->model['resource'].'.edit', [
            'category' => CategoryService::get_current_item($this->model['name'], $id),
            'meta' => ['title' => 'Панель управления - Редактирование категории'],
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, Category $category)
    {
        //Data validate
        $data = $request->validated();
        //dd($data);
        $item = $category;

        // Item store
        CategoryService::store($item, $data, $this->model, $this->img, 'update');
        return redirect(route($this->model['resource'].'.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($ids)
    {
        // Delete items
        CategoryService::destroy($this->model, $ids, true);
        return redirect(route($this->model['resource'].'.index'));

    }
}
