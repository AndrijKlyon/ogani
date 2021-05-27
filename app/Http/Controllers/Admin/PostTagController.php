<?php

namespace App\Http\Controllers\Admin;

use App\EModels\PostTag;
use App\Facades\PostTagService;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Requests\PostTagRequest;

class PostTagController extends AdminController
{
    protected $model = array(
        'resource' => 'post_tags',
        'name' => 'PostTag',
        'local_name' => 'Тег постов',
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
            'meta' => ['title' => 'Панель управления - Теги постов'],
            'tags' => PostTag::latest('id')->paginate(10),
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
            'meta' => ['title' => 'Панель управления - Создание тега постов'],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostTagRequest $request, PostTag $posttag)
    {
        // Data validate
        $data = $request->validated();
        $item = $posttag;

        // Item store
        PostTagService::store($item, $data, $this->model, $this->img);

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
            'meta' => ['title' => 'Панель управления - Информация о теге постов'],
            'tag' => PostTagService::get_current_item($this->model['name'], $id),
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
            'tag' => PostTagService::get_current_item($this->model['name'], $id),
            'meta' => ['title' => 'Панель управления - Редактирование тега постов'],
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostTagRequest $request, $id)
    {
        //Data validate
        $data = $request->validated();
        $item = PostTagService::get_current_item($this->model['name'], $id);

        // Item store
        PostTagService::store($item, $data, $this->model, $this->img, 'update');
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
        PostTagService::destroy($this->model, $ids, true);
        return redirect(route($this->model['resource'].'.index'));
    }
}
