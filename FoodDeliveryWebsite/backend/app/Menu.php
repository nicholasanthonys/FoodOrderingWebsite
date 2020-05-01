<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    public $timestamps = false;
    public $incrementing = false;

    public function orders(){
        return $this->belongsToMany('App\Order')->withPivot('quantity','price');
    }

    public function promos(){
        return $this->hasMany('App\Promo');
    }
}
