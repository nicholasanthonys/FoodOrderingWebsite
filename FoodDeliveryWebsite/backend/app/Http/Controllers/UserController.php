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

        //if failed return null
        if($isLoginSucess){
            return response()->json([
                'user' => $user
            ],201);
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
                'newUser' => $newUser,
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
     * 
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * //getUser
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $req)
    {
        $user = User::find($req->email);
        return response()->json([
            'user'=>$user
        ],201);
    }

    /**
     * Update the specified resource in storage.
     *route : put updateProfile
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req)
    {
        $user = User::find($req->email);
        $user->name = $req->name;
        $user->dob = $req->dob;
        $user->address = $req->address;
        $user->province = $req->province;
        $user->city = $req->city;
        $user->save();

        return response()->json([
            'updatedUser' => $user
        ],201);
    }

    //put updatePassword
    public function updatePassword(Request $req){
        $user = User::find($req->email);
        $user->password = Hash::make($req->newPassword);
        $user->save();

        return response()->json([
            'status'  => "update password berhasil"
        ],201);
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
