<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = "users";

    /* custom primary key
        https://stackoverflow.com/questions/34582535/laravel-5-2-use-a-string-as-a-custom-primary-key-for-eloquent-table-becomes-0
    */
    protected $primaryKey = "email";
    public $incrementing = false;
    protected $keyType = 'string';

    /* atribute hidden agar tidak kelihatan ketika di return */
    protected $hidden = [
        'password'
        // 'remember_token',
    ];


    public $timestamps = false;
}
