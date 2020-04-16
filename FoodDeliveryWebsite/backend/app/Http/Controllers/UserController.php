<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * login 
     *@param  \Illuminate\Http\Request  
     * @return \Illuminate\Http\Response
     */
    public function logIn(Request $req)
    {
        $isLoginSucess = false;

        $user = User::where('email',$req->email)->first();
        if($user){
            //check password
            if(Hash::check ($req->password, $user->password)){
                //bisa login
                $isLoginSucess = true;
            }
            else{
                //password salah, status tidak boleh ditampilkan demi alasan keamanan
                // return response()->json([
                //     'messsage' => 'password salah'
                // ],401);
            }
        }

        if($isLoginSucess){
            return response()->json([
                'logInStatus' => 'success'
            ],201);
        }else{
            return response()->json([
                'logInStatus' => 'failed'
            ],401);
        }
    }

    /**
     * sign up to create new user
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function signUp(Request $req)
    {
        $user = User::find($req->email) ;

        if (!$user) { //check user udah terdaftar apa belom
            $newUser = new User;
            $newUser->name = $req->name;
            $newUser->email = $req->email;
            //hashing password
            $newUser->password = Hash::make($req->password);
            $newUser->dob = $req->dob;
            $newUser->address = $req->address;
            $newUser->province = $req->province;
            $newUser->city = $req->city;
             $newUser->save();
            return response()->json([
                'newuser' => $newUser,
                'signUp' => 'success'
            ], 201);
        } else {
            //karena udah ada usernya
            return response()->json([
                'signUp' => 'failed'
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
