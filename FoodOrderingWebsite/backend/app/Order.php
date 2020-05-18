<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public $timestamps = false;
       
    public function menus(){
        return $this->belongsToMany('App\Menu')->withPivot('quantity','price');
    }
}
