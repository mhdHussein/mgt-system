<?php

use Faker\Generator as Faker;
use App\User;
use App\Model\Courier;

$factory->define(App\Model\ShipmentInfo::class, function (Faker $faker) {

    

    return [
        'sent_count' => $faker->numberBetween(10,20),
        'sent_amount' => $faker->numberBetween(15,500),
        'cash' => $faker->numberBetween(15,500),
        'credit' => $faker->numberBetween(15,500),
        'deposited_amount' => $faker->numberBetween(15,500),
        'returned_shipments' => $faker->numberBetween(5,10),
        'delivared_shipments' => $faker->numberBetween(20,100),
        'fiscal_deficit' => $faker->numberBetween(10,300),
        'lost_shipments' => $faker->numberBetween(10,20),
        'fuel' => 25,
        'supervisor_id' => function(){
            return User::where('role_id' , 4)->get()->random();
        },
        'courier_id' => function(){
            return Courier::all()->random();
        },

        'created_at' => $faker->dateTimeBetween($startDate = '-3 months' , $endDate =  'now')
        
    ];
});
