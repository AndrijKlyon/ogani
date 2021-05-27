<?php

namespace App\Http\Controllers\Admin;

use App\Facades\CacheService;
use App\Http\Controllers\Admin\AdminController;
use Illuminate\Http\Request;


class CacheController extends AdminController
{
    public function index() {
        return View('admin.cache.index', [
            'meta' => ['title' => 'Панель управления - Очистка кэша']
        ]);
    }

    public function cacheClear(Request $request) {
        CacheService::clearCache($request->keys);
        return redirect(route('admin.cache'));
    }


    public function tempfolderDelete(Request $request) {
        CacheService::clearTempfolder($request->folders);
        return redirect(route('admin.cache'));
    }

}
