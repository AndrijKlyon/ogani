<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Requests\ProductRequest;

use App\EModels\Brand;
use App\EModels\Modification;
use App\EModels\Option;
use App\EModels\Product;
use App\EModels\ProductImage;
use App\EModels\Specification;

use App\Facades\ProductService;

class ProductController extends AdminController
{
    protected $model = array(
        'resource' => 'products',
        'name' => 'Product',
        'local_name' => 'Товар',
        'field' => 'title'
    );
    protected $img = false;
    protected $imgs = array(
        'width' => 450,
        'height' => 450
    );

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return View('admin.'.$this->model['resource'].'.index', [
            'meta' => ['title' => 'Панель управления - Товары'],
            'products' => Product::latest('id')->with('category')->paginate(10),
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
            'meta' => ['title' => 'Панель управления - Создание товара'],
            'brands' => Brand::all(),
            'options' => Option::orderBy('title', 'asc')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request, Product $product)
    {
        // Data validate
        $data = $request->validated();

        // Item store
        $item = $product;
        ProductService::store($item, $data, $this->model, $this->img, 'save', $this->imgs);

        return redirect(route($this->model['resource'].'.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return View('admin.'.$this->model['resource'].'.show', [
            'meta' => ['title' => 'Панель управления - Информация о товаре'],
            'product' => ProductService::get_current_item($this->model['name'], $id),
            'gallery_images' => ProductImage::where('product_id', $id)->get(),
            'specifications' => Specification::where('product_id', $id)->get(),
            'modifications' => Modification::where('product_id', $id)->with('option')->get(),
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
            'product' => ProductService::get_current_item($this->model['name'], $id),
            'meta' => ['title' => 'Панель управления - Редактирование товара'],
            'brands' => Brand::all(),
            'gallery_images' => ProductImage::where('product_id', $id)->get(),
            'specifications' => Specification::where('product_id', $id)->get(),
            'product_modifications' => Modification::where('product_id', $id)->get(),
            'modifications' => Modification::where('product_id', $id)->get(),
            'options' => Option::orderBy('title', 'asc')->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, Product $product)
    {
        // Data validate
        $data = $request->validated();

        // Update item
        $item = $product;
        ProductService::store($item, $data, $this->model, $this->img, 'update', $this->imgs);

        return redirect(route($this->model['resource'].'.index'));}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($ids)
    {
        // Delete item
        ProductService::destroy($this->model, $ids, true, true);
        return redirect(route($this->model['resource'].'.index'));
    }

}


