<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Site\SiteController;
use App\Http\Requests\UserProfileRequest;


use App\Facades\OrderService;
use App\Facades\UserAvatarService;
use App\Facades\UserService;
use Illuminate\Support\Facades\Auth;

class CabinetController extends SiteController
{

    public function profile_get() {
        return View('site.cabinet.index', [
            'meta' => [
                'title' => config('template_settings.site.title') . ' - Кабинет пользователя',
                'keywords' => '',
                'description' => '',
            ],
            'user' => Auth::user(),
            'page' => 'profile',
            'breadcrumb_title' => 'Кабинет пользователя'
        ]);
    }

    public function profile_post(UserProfileRequest $request) {
        $data = $request->validated();
        $path = UserAvatarService::update_avatar($request, Auth::user()->id);
        UserService::change_profile($path, $data);
        return back();
    }

    public function orders() {
        return View('site.cabinet.index', [
            'meta' => [
                'title' => config('template_settings.site.title') . ' - Кабинет пользователя',
                'keywords' => '',
                'description' => '',
            ],
            'orders' => OrderService::getUserOrders(Auth::user()->id),
            'page' => 'orders',
            'breadcrumb_title' => 'Кабинет пользователя'
        ]);
    }
}

