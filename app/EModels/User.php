<?php

namespace App\EModels;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravelista\Comments\Commenter;

class User extends Authenticatable
{
    use Notifiable, Commenter;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role', 'firstname', 'lastname', 'address', 'phone', 'img', 'description'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function hasRole($role)
    {
        if($this->role === $role) return true;
        else return false;
    }

    public function isAdmin()
    {
        if($this->role === 'admin') return true;
        else return false;
    }

    public function orders() {
        return $this->hasMany('App\EModels\Order');
    }

    public function getFullName() {
        return $this->firstname . ' ' . $this->lastname;
    }

}
