<?php

use Faker\Generator as Faker;
use App\Model\Courier;
use App\User;

$factory->define(App\Model\Attendance::class, function (Faker $faker) {
    return [
        'courier_id' => function(){
            return Courier::all()->random();
        },
        'supervisor_id' => function(){
            return User::where('role_id' , 4)->get()->random();
        },
        'created_at' => $faker->dateTimeBetween($startDate = '-2 weeks' , $endDate =  'now')
    ];
});
