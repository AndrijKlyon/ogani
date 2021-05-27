<?php

namespace App\EModels;

use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    protected $table = 'contact_messages';
    protected $guarded = [];

    public function user()
    {
        return $this->hasOne('App\User', 'name','user_name');
    }
}
