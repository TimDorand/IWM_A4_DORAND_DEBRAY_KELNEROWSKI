<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    public function rates(){
        return $this->hasMany('App\Rate');
    }
}
