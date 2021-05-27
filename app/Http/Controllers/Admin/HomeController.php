<?php

namespace App\Http\Controllers\Admin;

use App\EModels\Category;
use App\EModels\Order;
use App\EModels\Product;
use App\Http\Controllers\Admin\AdminController;
use App\User;

class HomeController extends AdminController
{
    public function index() {

        return View('admin.home', [
            'new_orders_count' => Order::where('status_id', 1)->count(),
            'users_count' => User::count(),
            'products_count' => Product::count(),
            'categories_count' => Category::count(),
            'meta' => ['title' => 'Панель управления - Главная'],
        ]);
    }
}
