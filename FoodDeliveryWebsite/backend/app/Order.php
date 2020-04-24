<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    
    public function menus(){
        return $this->belongsToMany('App\Menu');
    }
}
