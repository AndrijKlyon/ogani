<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends AdminController
{
    public function login(Request $request) {

        if($request->isMethod('get')) {
            if(!Auth::check()) return View('admin.login');
            if(Auth::check() && User::where('id', Auth::user()->id)->first()->hasRole('admin')) return redirect(route('admin.home'));
            if(Auth::check() && !User::where('id', Auth::user()->id)->first()->hasRole('admin')) return redirect('/');

        }

        if($request->isMethod('post')) {
            $userdata = array(
                'name' => $request['name'],
                'password' => $request['password']
              );
            if (Auth::attempt($userdata)) {
                return back();
            }
                return back()->withErrors(['login_error'=>'Неверное имя пользователя или пароль'])->withInput();
        }
    }

}
