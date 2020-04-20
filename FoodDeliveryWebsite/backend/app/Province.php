<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    public $incrementing = false;
    public $timestamps = false;
    public $keyType = 'string';

    public function cities (){
        return $this->hasMany('App\City');
    }
}
