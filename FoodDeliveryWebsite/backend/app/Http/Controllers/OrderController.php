<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Order;
use App\Menu;
use Carbon\Carbon;

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

        /* 
            struktur json 
            {
                "email" : "bokir@gmail.com",
                "totalPrice" : 1250000,
                "orderStatus" : "arrived",
                "paid" : 1,
                "menus" : [
                    {
                        "id" : "drk02",
                        "quantity" : 2,
                        "price" :  12000
                    },
                    {
                        "id" : "drk03",
                        "quantity" : 1,
                        "price" : 12000
                        
                    }
                ]

            }
        */

        $order=  new Order();
        $order->customer = $request->email;
        $order->total_price = $request->totalPrice;
        $order->order_status = $request->orderStatus;
        $order->paid = $request->paid;
        $order->order_time = Carbon::now();


        //asumsi : shipped time sama dengan order time
        $order->shipped_time = Carbon::now();
        
        //ambil array menus
        $menus = $request->menus;

        //count total price
        // $totalPrice = 0;
        // foreach($menus as $menu){
        //     $totalPrice += $menu['price'] * $menu['quantity'];
        // }
        // $order->total_price = $totalPrice;
        $order->save();

        //save order to menu_order table
        foreach($menus as $temp){
           $menu = Menu::find($temp['id']);
             $order->menus() -> attach([
                $menu->id => [
                    'quantity'=> $temp['quantity'],
                    'price' => $temp['price']                  
                    ]
            ]);
        }

        return response()->json([
            'newOrder' => $request->menus
        ],201);
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

    //post /historyorders
    public function showHistoryOrders(Request $req){
        //select all order based on user email
        $allUserOrder = Order::where('customer',$req->email) -> get();
        foreach ($allUserOrder as $order) {
            $order['menus'] = $order->menus;
        }
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
     * delete : /api/historyorders/clear
     * @param  \App\Province  $province
     * @return \Illuminate\Http\Response
     */
    public function clearHistory(Request $req)
    {
        $orders = Order::where('customer',$req->email);
        
        //get array
        $arrayOrders = $orders->get();

        foreach ($arrayOrders as $order) {
            //hapus semua menu dalam order di database
            $menus = $order->menus()->detach();
        }
        //hapus semua orders berdasarkan email
        $orders->delete();
        
        return response()->json([
            'orders' => $orders,
        ],201);

        // $order = Order::where('customer',$req->email)->first();
        // $menus = $order->menus()->detach();
        // return response()->json([
        //     "menus" =>$menus
        // ],201);

    }
}
