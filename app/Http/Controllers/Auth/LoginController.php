<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Site\SiteController;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends SiteController
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        parent::__construct();
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        $meta = [
            'title' => config('template_settings.site.title') . ' - Аутентификация',
            'keywords' => 'Аутентификация на сайте',
            'description' => 'Аутентификация на сайте ' . config('template_settings.site.title'),
        ];
        return view('auth.login', [
            'meta' => $meta,
        ]);
    }

    public function username() {
        return 'name';
    }


    public function loginmodal (Request $request) {

        if (Auth::attempt(['name'=>$request->name, 'password'=>$request->password])) {
            // Аутентификация пройдена ...
            return back();
        }
        if($request->ajax()) {
            return 'login_error';
        }
        return back()->withErrors(['name'=>'Неверное имя пользователя или пароль'])->withInput();
    }

}
