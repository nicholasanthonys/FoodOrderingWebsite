<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('menu_order')->insert([
            ['order_id' => '1',
            'menu_id' => 'drk07',
            'quantity' => 2,
            'price' => 16000],

            ['order_id' => '1',
            'menu_id' => 'sld04',
            'quantity' => 1,
            'price' => 19000],

            ['order_id' => '1',
            'menu_id' => 'stk07',
            'quantity' => 1,
            'price' => 170000]
        ]);
    }
}
