<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Menu;
use App\Promo;
use Carbon\Carbon;

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
        $today = Carbon::now()->toDateString();
        $listMenus = Menu::where('type', 'pasta')->get();
        foreach ($listMenus as $menu) {
            $menu['promo'] = $menu->promos
            ->where('start_date', '<=', $today)
            ->where('end_date', '>', $today)
            ->first();

            if($menu['promo'] !=null){
                $menu['old_price'] = $menu->price;
                $menu->price = $menu['promo']->new_price;
            }
        }
        return response()->json([
            'menus' => $listMenus,
            "today"=>$today
        ], 201);
    }

    //Route::get('menus/steak','MenuController@indexSteak');
    public function indexSteak()
    {
        $today = Carbon::now()->toDateString();
        $listMenus = Menu::where('type', 'steak')->get();
        foreach ($listMenus as $menu) {
            $menu['promo'] = $menu->promos
            ->where('start_date', '<=', $today)
            ->where('end_date', '>', $today)
            ->first();

            if($menu['promo'] !=null){
                $menu['old_price'] = $menu->price;
                $menu->price = $menu['promo']->new_price;
            }
        }
        return response()->json([
            'menus' => $listMenus
        ], 201);
    }

    //Route::get('menus/pizza','MenuController@indexPizza');
    public function indexPizza()
    {
        $today = Carbon::now()->toDateString();

        $listMenus = Menu::where('type', 'pizza')->get();
        foreach ($listMenus as $menu) {
            $menu['promo'] = $menu->promos
            ->where('start_date', '<=', $today)
            ->where('end_date', '>', $today)
            ->first();

            if($menu['promo'] !=null){
                $menu['old_price'] = $menu->price;
                $menu->price = $menu['promo']->new_price;
            }
        }
        return response()->json([
            'menus' => $listMenus
        ], 201);
    }

    // Route::get('menus/rice','MenuController@indexRice');
    public function indexRice()
    {
        $today = Carbon::now()->toDateString();

        $listMenus = Menu::where('type', 'rice')->get();
        foreach ($listMenus as $menu) {
            $menu['promo'] = $menu->promos
            ->where('start_date', '<=', $today)
            ->where('end_date', '>', $today)
            ->first();

            if($menu['promo'] !=null){
                $menu['old_price'] = $menu->price;
                $menu->price = $menu['promo']->new_price;
            }
        }
        return response()->json([
            'menus' => $listMenus
        ], 201);
    }

    // Route::get('menus/soup','MenuController@indexSoup');
    public function indexSoup()
    {
        $today = Carbon::now()->toDateString();

        $listMenus = Menu::where('type', 'soup')->get();
        foreach ($listMenus as $menu) {
            $menu['promo'] = $menu->promos
            ->where('start_date', '<=', $today)
            ->where('end_date', '>', $today)
            ->first();

            if($menu['promo'] !=null){
                $menu['old_price'] = $menu->price;
                $menu->price = $menu['promo']->new_price;
            }
        }
        return response()->json([
            'menus' => $listMenus
        ], 201);
    }

    // Route::get('menus/salad','MenuController@indexSalad');
    public function indexSalad()
    {
        $today = Carbon::now()->toDateString();

        $listMenus = Menu::where('type', 'salad')->get();
        foreach ($listMenus as $menu) {
            $menu['promo'] = $menu->promos
            ->where('start_date', '<=', $today)
            ->where('end_date', '>', $today)
            ->first();

            if($menu['promo'] !=null){
                $menu['old_price'] = $menu->price;
                $menu->price = $menu['promo']->new_price;
            }
        }
        return response()->json([
            'menus' => $listMenus
        ], 201);
    }

    // Route::get('menus/drinks','MenuController@indexDrinks');
    public function indexDrinks()
    {
        $today = Carbon::now()->toDateString();

        $listMenus = Menu::where('type', 'drink')->get();
        foreach ($listMenus as $menu) {
            $menu['promo'] = $menu->promos
            ->where('start_date', '<=', $today)
            ->where('end_date', '>', $today)
            ->first();

            if($menu['promo'] !=null){
                $menu['old_price'] = $menu->price;
                $menu->price = $menu['promo']->new_price;
            }
        }
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
        $now = Carbon::now();
        $today = $now->toDateTimeString();

        // $promos = Promo::all();
        //Mengambil promo yang sesuai tanggal
        $promos = Promo::where('start_date', '<=', $today)->where('end_date', '>', $today)->get();
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
    public function indexNewest()
    {
        $listMenus = Menu::orderBy('date_added', 'DESC')
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
        $today = Carbon::now()->toDateString();

        $menu = Menu::find($idMenu);
        $promo =  $menu->promos
        ->where('start_date', '<=', $today)
        ->where('end_date', '>', $today)
        ->first();

        if($promo != null){
            $menu['old_price'] = $menu->price;
            $menu['price'] = $promo->new_price;
            
        }
    
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
