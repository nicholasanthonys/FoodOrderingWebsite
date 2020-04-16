<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => "bokir",
            'email' => "bokir".'@gmail.com',
            'password' => Hash::make('password'),
            'dob' => "1999-08-12",
            'address' => 'Perumahan Cibaduyut',
            'province' => 'West Java',
            'city' =>  'Bandung'
        ]);
    }
}
