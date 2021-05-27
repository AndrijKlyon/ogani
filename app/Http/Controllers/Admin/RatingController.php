<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Http\Request;

use App\EModels\Rating;

use App\Facades\RatingService;

class RatingController extends AdminController
{
    protected $model = array(
        'resource' => 'ratings',
        'name' => 'Rating',
        'local_name' => 'Рейтинговая оценка',
        'field' => 'id'
    );
    protected $img = false;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return View('admin.'.$this->model['resource'].'.index', [
            'meta' => ['title' => 'Панель управления - Рейтинговые оценки'],
            'ratings' => Rating::latest('id')->with('user', 'product')->paginate(10),
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($ids)
    {
        // Delete items
        RatingService::destroy($this->model, $ids);
        return redirect(route($this->model['resource'].'.index'));
    }
}
