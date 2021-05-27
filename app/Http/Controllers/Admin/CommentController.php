<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Http\Request;

use App\EModels\Comment;

use App\Facades\CommentService;

class CommentController extends AdminController

{
    protected $model = array(
        'resource' => 'admincomments',
        'name' => 'Comment',
        'local_name' => 'Комментарий',
        'field' => 'id'
    );
    protected $img = false;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //dd(Comment::latest('id')->with('user', 'commentable')->paginate(10));
        return View('admin.'.$this->model['resource'].'.index', [
            'meta' => ['title' => 'Панель управления - Комментарии'],
            'elements' => Comment::latest('id')->with('user', 'commentable')->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $item = CommentService::get_current_item($this->model['name'], $id);
        CommentService::viewed($item);

        return View('admin.'.$this->model['resource'].'.show', [
            'meta' => ['title' => 'Панель управления - Информация о комментарии'],
            'element' => $item,
            'parent' => Comment::where('id', $item->child_id)->first(),
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $item = CommentService::get_current_item($this->model['name'], $id);
        CommentService::viewed($item);

        return View('admin.'.$this->model['resource'].'.edit', [
            'element' => $item,
            'meta' => ['title' => 'Панель управления - Редактирование комментария'],
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $item = CommentService::get_current_item($this->model['name'], $id);

        CommentService::store($item, $request->input(), $this->model, $this->img, 'update');
        return redirect(route($this->model['resource'].'.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($ids)
    {
        // Delete item
        CommentService::destroy($this->model, $ids);
        return back();
    }
}
