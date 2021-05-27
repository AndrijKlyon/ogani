<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Admin\AdminController;
use App\Http\Requests\UserRequest;

use App\User;

use App\Facades\UserService;

class UserController extends AdminController
{
    protected $model = array(
        'resource' => 'users',
        'name' => 'User',
        'local_name' => 'Пользователь',
        'field' => 'name'
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
            'meta' => ['title' => 'Панель управления - Пользователи'],
            'users' => User::latest('id')->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return View('admin.'.$this->model['resource'].'.create', [
            'meta' => ['title' => 'Панель управления - Создание пользователя'],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request, User $user)
    {
        $data = $request->validated();
        $item = $user;

        // Item store
        UserService::store($item, $data, $this->model, $this->img, 'save', true);

        return redirect(route($this->model['resource'].'.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = User::where('id', $id)->with('orders')->first();
        return view('admin.'.$this->model['resource'].'.show', [
            'meta' => ['title' => 'Панель управления - Пользователь'],
            'user' => $user
        ]);
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('admin.'.$this->model['resource'].'.edit', [
            'user' => UserService::get_current_item($this->model['name'], $id),
            'meta' => ['title' => 'Панель управления - Редактирование пользователя'],
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, $id)
    {
        $data = $request->validated();
        $item = UserService::get_current_item($this->model['name'], $id);

        // Item store
        UserService::store($item, $data, $this->model, $this->img, 'update', true);
        return redirect(route($this->model['resource'].'.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($ids)
    {
        // Delete items
        UserService::destroy($this->model, $ids, true, true);
        return redirect(route($this->model['resource'].'.index'));
    }

}
