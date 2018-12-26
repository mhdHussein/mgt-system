<?php

use Faker\Generator as Faker;
use App\Model\City;

$factory->define(App\Model\City::class, function (Faker $faker) {
    return [
        'name' => $faker->city(),
       
    ];
});
