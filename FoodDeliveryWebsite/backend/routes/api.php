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

/* Form LOGIN REGISTER---------------------- */
Route::post('signup','UserController@signUp');
Route::post('login', 'UserController@logIn');

//get list all provinces
Route::get('provinces', 'ProvinceController@index');

/*get cities by province id
menampilkan city berdasarkan id provinsi */
Route::get('cities/province/{idProvince}', 'CityController@getCityByProvinceId');

/* END Form LOGIN REGISTER---------------------- */

/* MENU----------------------------------------------------*/
//get list all menus
Route::get('menus','MenuController@index');

//pasta
Route::get('menus/pasta','MenuController@indexPasta');

//steak
Route::get('menus/steak','MenuController@indexSteak');

//pizza
Route::get('menus/pizza','MenuController@indexPizza');

//rice
Route::get('menus/rice','MenuController@indexRice');

//soup
Route::get('menus/soup','MenuController@indexSoup');

//salad
Route::get('menus/salad','MenuController@indexSalad');

//drinks
Route::get('menus/drinks','MenuController@indexDrinks');

//get specific menu
Route::get('menus/{idMenu}', 'MenuController@show');

/* MENU END ------------------------------------------*/


/*ORDER-------------------------------------------------- */
//get list all orders
Route::get('orders', 'OrderController@index');
//insert order
Route::post('orders','OrderController@store');

//get 1 user order
Route::post('showorder', 'OrderController@showUserOrder');
//get histroy order
Route::post('historyorders', 'OrderController@showHistoryOrders');

//get menu from order based on user email and order id
Route::post('showmenuorder','OrderController@showUserMenuOrder');

/*END ORDER-------------------------------------------------- */


//get user based on email
Route::post("getUser","UserController@edit");

//update user profile
Route::put('updateProfile',"UserController@update");

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
