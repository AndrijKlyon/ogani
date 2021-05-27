<?php

namespace App\EModels;

use Illuminate\Database\Eloquent\Model;

class Modification extends Model
{
    protected $table = 'modifications';

    public function option() {
        return $this->hasOne('App\EModels\Option','id', 'option_id');
    }


}
