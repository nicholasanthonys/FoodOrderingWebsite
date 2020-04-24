<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Menu;

class MenuController extends Controller
{
    /**
     * Menampilkan semua model
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $listMenus = Menu::all();
       return response() -> json([
           'menus' => $listMenus
       ],201);
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
     *
     * @return \Illuminate\Http\Response
     */
    public function show($idMenu)
    {
        $menu = Menu::find($idMenu);
        return response() -> json([
            'menu' => $menu
        ],201);
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
