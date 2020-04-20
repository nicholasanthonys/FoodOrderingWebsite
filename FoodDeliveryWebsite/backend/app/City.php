<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    public $incrementing = false;
    public $timestamps = false;
    public $keyType = 'string';
    
    public function province(){
        return $this->belongsTo('App\Province');
    }
}
