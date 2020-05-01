<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        /* https://laravel.com/docs/7.x/seeding */
        //Masukin seeder class disini lalu run php artisan db:seed
        $this->call([
            MenuSeeder::class,
            ProvinceSeeder::class,
            CitySeeder::class,
            UserSeeder::class,
            OrderSeeder::class,
            MenuOrderSeeder::class,
            PromoSeeder::class
        ]);
    }
}
