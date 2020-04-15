<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Users extends Controller
{
    public function SignUp(Request $req)
    {
        $results = DB::select('select * from users where email = ?', [$req->input("email")]);
        $pesan = '';

        if(!$results){ //check user udah terdaftar apa belom
                $user = new user();
                $user ->name = $req->input('name');
                $user ->email = $req->input('email');
                $user ->password = $req->input('password');
                $user->dob = $req->input('dob');
                $user->address = $req->input('address');
                $user->province = $req->input('province');
                $user->city = $req->input('city');
                $user ->save();
                //return redirect('')->with('user', $user)->with('alert', 'Sign Up Success');
        } else {
            return redirect()->back()->with('alert', 'User sudah terdaftar!');//kalo udah terdaftar
        }
    }
}
