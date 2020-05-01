<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PromoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('promos')->insert([
            ['menu' => 'pst03',
            'new_price' => 42000,
            'start_date' => Carbon::create('2020', '01', '01'),
            'end_date' => Carbon::create('2020', '04', '30')],

            ['menu' => 'stk06',
            'new_price' => 220000,
            'start_date' => Carbon::create('2020', '01', '01'),
            'end_date' => Carbon::create('2020', '04', '30')],

            ['menu' => 'pst05',
            'new_price' => 41000,
            'start_date' => Carbon::create('2020', '03', '01'),
            'end_date' => Carbon::create('2020', '06', '30')],

            ['menu' => 'stk03',
            'new_price' => 175000,
            'start_date' => Carbon::create('2020', '03', '01'),
            'end_date' => Carbon::create('2020', '06', '30')],

            ['menu' => 'stk09',
            'new_price' => 110000,
            'start_date' => Carbon::create('2020', '03', '01'),
            'end_date' => Carbon::create('2020', '06', '30')],

            ['menu' => 'piz06',
            'new_price' => 72000,
            'start_date' => Carbon::create('2020', '03', '01'),
            'end_date' => Carbon::create('2020', '06', '30')],

            ['menu' => 'piz13',
            'new_price' => 71000,
            'start_date' => Carbon::create('2020', '03', '01'),
            'end_date' => Carbon::create('2020', '06', '30')],

            ['menu' => 'sou02',
            'new_price' => 18500,
            'start_date' => Carbon::create('2020', '03', '01'),
            'end_date' => Carbon::create('2020', '06', '30')],

            ['menu' => 'sld03',
            'new_price' => 16500,
            'start_date' => Carbon::create('2020', '05', '01'),
            'end_date' => Carbon::create('2020', '08', '30')],
        ]);
    }
}
