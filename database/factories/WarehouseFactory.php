<?php

use Faker\Generator as Faker;
use App\Model\City;

$factory->define(App\Model\Warehouse::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'city_id' => function(){
            return City::all()->random();
        }
    ];
});
