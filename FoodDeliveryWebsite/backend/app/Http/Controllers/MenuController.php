<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Menu;
use App\Promo;

class MenuController extends Controller
{
    /**
     * Menampilkan semua model
     *Route::get('menus','MenuController@index');
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listMenus = Menu::all();
        return response()->json([
            'menus' => $listMenus
        ], 201);
    }
    //Route::get('menus/pasta','MenuController@indexPasta');
    public function indexPasta()
    {
        $listMenus = Menu::where('type', 'pasta')->get();
        return response()->json([
            'menus' => $listMenus
        ], 201);
    }

    //Route::get('menus/steak','MenuController@indexSteak');
    public function indexSteak()
    {
        $listMenus = Menu::where('type', 'steak')->get();
        return response()->json([
            'menus' => $listMenus
        ], 201);
    }

    //Route::get('menus/pizza','MenuController@indexPizza');
    public function indexPizza()
    {
        $listMenus = Menu::where('type', 'pizza')->get();
        return response()->json([
            'menus' => $listMenus
        ], 201);
    }

    // Route::get('menus/rice','MenuController@indexRice');
    public function indexRice()
    {
        $listMenus = Menu::where('type', 'rice')->get();
        return response()->json([
            'menus' => $listMenus
        ], 201);
    }

    // Route::get('menus/soup','MenuController@indexSoup');
    public function indexSoup()
    {
        $listMenus = Menu::where('type', 'soup')->get();
        return response()->json([
            'menus' => $listMenus
        ], 201);
    }

    // Route::get('menus/salad','MenuController@indexSalad');
    public function indexSalad()
    {
        $listMenus = Menu::where('type', 'salad')->get();
        return response()->json([
            'menus' => $listMenus
        ], 201);
    }

    // Route::get('menus/drinks','MenuController@indexDrinks');
    public function indexDrinks()
    {
        $listMenus = Menu::where('type', 'drink')->get();
        return response()->json([
            'menus' => $listMenus
        ], 201);
    }


    public function indexRecommended()
    {
        $listMenus = Menu::where('chef_recommended', 1)->get();
        return response()->json([
            'menus' => $listMenus
        ], 201);
    }

/// get /promo
    public function indexPromo()
    {
        $promos = Promo::all();
        foreach ($promos as $promo) {
            $menu = Menu::find($promo->menu_id);
            $promo['name'] = $menu->name;
            $promo['type'] = $menu->type;
            $promo['url_image'] = $menu->url_image;
            $promo['description'] = $menu->description;
            $promo['old_price'] = $menu->price;
            $promo['chef_recommended'] = $menu->chef_recommended;
            
        }

        return response()->json([
            'promo' => $promos
        ], 201);
    }

    // get /newest
    public function indexNewest(){
        $listMenus = Menu::orderBy('date_added','DESC')
            ->take(8)
            ->get();
        return response()->json([
            'menus' => $listMenus
        ], 201);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     *api : menus/{idMenu}
     * @return \Illuminate\Http\Response
     */
    public function show($idMenu)
    {
        $menu = Menu::find($idMenu);
        return response()->json([
            'menu' => $menu
        ], 201);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * 
     * @return \Illuminate\Http\Response
     */
    public function edit($idMenu)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Province  $province
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Menu $menu)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Province  $province
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
        //
    }
}
