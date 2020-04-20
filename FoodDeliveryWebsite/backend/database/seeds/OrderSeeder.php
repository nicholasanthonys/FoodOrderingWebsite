<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('orders')->insert([
            'customer' => "bokir".'@gmail.com',
            'total_price' => 205000,
            'order_status' => 'arrived',
            'paid' => '1',
            'order_time' => '2019-04-19 17:23:14',
            'shipped_time' => '2019-04-19 17:34:53'
        ]);
    }
}
