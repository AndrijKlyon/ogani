<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Requests\PostRequest;

use App\EModels\Post;
use App\EModels\PostCategory;
use App\EModels\PostTag;

use App\Facades\PostService;

class PostController extends AdminController
{
    protected $model = array(
        'resource' => 'posts',
        'name' => 'Post',
        'local_name' => 'Пост',
        'field' => 'title'
    );
    protected $img = array(
        'width' => 750,
        'height' => 380
    );

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return View('admin.'.$this->model['resource'].'.index', [
            'meta' => ['title' => 'Панель управления - Посты'],
            'posts' => Post::latest('id')->paginate(10),
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
            'meta' => ['title' => 'Панель управления - Создание поста'],
            'categories' => PostCategory::all(),
            'tags' => PostTag::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request, Post $post)
    {
        // Data validate
        $data = $request->validated();
        $item = $post;

        // Item store
        PostService::store($item, $data, $this->model, $this->img, true);

        return redirect(route($this->model['resource'].'.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return View('admin.'.$this->model['resource'].'.show', [
            'meta' => ['title' => 'Панель управления - Информация о посте'],
            'post' => PostService::get_current_item($this->model['name'], $id),
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
            'post' => PostService::get_current_item($this->model['name'], $id),
            'meta' => ['title' => 'Панель управления - Редактирование поста'],
            'categories' => PostCategory::all(),
            'tags' => PostTag::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request, Post $post)
    {
        //Data validate
        $data = $request->validated();
        $item = $post;

        // Item store
        PostService::store($item, $data, $this->model, $this->img, 'update', true);

        return redirect(route($this->model['resource'].'.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($ids)
    {
        // Delete item
        PostService::destroy($this->model, $ids, false, true);

        return redirect(route($this->model['resource'].'.index'));

    }

}

