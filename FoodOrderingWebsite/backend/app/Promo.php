<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{

    public function menu(){
        return $this->belongsTo('App\Menu');
    }
}
