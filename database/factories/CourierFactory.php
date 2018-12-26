<?php

use Faker\Generator as Faker;
use App\User;

$factory->define(App\Model\Courier::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'id_number' => $faker->numberBetween(5000 , 6000),
        'iqama' => $faker->numberBetween(70000 , 80000),
        'mobile' => $faker->phoneNumber(),
        'car_type' => $faker->word(),
        'plate' => $faker->word(),
        'nationality' => $faker->word(),
        'status' => $faker->randomElement([
            'active' , 'suspended' , 'terminated'
        ]),
        'hire_date' => $faker->dateTimeBetween($startDate = '-3 months' , $endDate =  'now'),
        'notes' => $faker->text(),

        'supervisor_id' => function(){
            $super = User::where('role_id' , 4)->get()->random();
            return $super;
        }
    ];
});
