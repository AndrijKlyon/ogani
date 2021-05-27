<?php

namespace App\Http\Controllers\Admin;

use App\Facades\ProductService;
use App\Http\Controllers\Admin\AdminController;
use Illuminate\Http\Request;

class SearchController extends AdminController
{
    public function index(Request $request) {
        $query = $request->input('search');
        $products = ProductService::getAllSearchedProduct($query);
            return View('admin.search_results', [
                'products' => $products,
                'meta' => ['title' => ' Панель управления - Результаты поиска'],
                'search_query' => e($query),
            ]);
    }
}
