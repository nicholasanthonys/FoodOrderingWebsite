<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    public function orders(){
        return $this->belongsToMany('App\Order');
    }
}
