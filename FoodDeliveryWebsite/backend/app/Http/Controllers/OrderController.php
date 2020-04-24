<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Order;

class OrderController extends Controller
{
        /**
     * Menampilkan semua model
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $orders = Order::all();

       return response()-> json([
           'orders' => $orders
       ]);
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
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function showUserOrder(Request $req)
    {   
        //select order with specific id based on user mail
        $order = Order::where('customer', $req->email)
            -> where('id', $req->idOrder)
            ->first();
        
        return response()-> json(
            $order
        );
    }

    //get menu from order based on user email and order id
    public function showUserMenuOrder(Request $req){
        //select order with specific id based on user mail
        $order = Order::where('customer', $req->email)
            -> where('id', $req->idOrder)
            ->first();

        $menus = $order->menus;

        return response()-> json([
            'menus' => $menus
        ]);
    }

    public function showHistoryOrders(Request $req){
        //select all order based on user email
        $allUserOrder = Order::where('customer',$req->email) -> get();

        return response()-> json($allUserOrder);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Province  $province
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Province  $province
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Province  $province
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
