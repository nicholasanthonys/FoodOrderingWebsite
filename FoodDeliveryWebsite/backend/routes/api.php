<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\User;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('signup','UserController@signUp');
Route::post('login', 'UserController@logIn');

//get list all provinces
Route::get('provinces', 'ProvinceController@index');

/*get cities by province id
menampilkan city berdasarkan id provinsi */
Route::get('cities/province/{idProvince}', 'CityController@getCityByProvinceId');

//get list all menus
Route::get('menus','MenuController@index');
//get specific menu
Route::get('menus/{idMenu}', 'MenuController@show');


//get list all orders
Route::get('orders', 'OrderController@index');

//get 1 user order
Route::post('showorder', 'OrderController@showUserOrder');
//get histroy order
Route::post('historyorders', 'OrderController@showHistoryOrders');

//get menu from order based on user email and order id
Route::post('showmenuorder','OrderController@showUserMenuOrder');


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
