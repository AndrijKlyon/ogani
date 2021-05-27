<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\User;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    // public function __construct(Auth $auth)
    // {
    //     $this->auth = $auth;
    // }

    public function handle($request, Closure $next, ... $roles)
{
    if (!Auth::check()) //
        //dd('ok');
        return redirect(url('admin/login'));

    $user = User::where('id', Auth::user()->id)->first();

    if($user->isAdmin())
        return $next($request);

    // foreach($roles as $role) {
    //     // Check if user has the role This check will depend on how your roles are set up
    //     if($user->hasRole($role)) {
    //         return $next($request);
    //     }
    // }
    return redirect(url('admin/login'));
}

}
