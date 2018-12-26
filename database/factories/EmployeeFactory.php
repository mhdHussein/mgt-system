<?php

use Faker\Generator as Faker;
use App\Model\Department;
use App\Model\City;

$factory->define(App\Model\Employee::class, function (Faker $faker) {
    return [
        'id_number' => $faker->numberBetween(5000 , 6000),
        'name' => $faker->name,
        'nationality' => $faker->city(),
        'marital_status' => $faker->randomElement([
            'Married' , 'Single'
        ]),
        'birth_date' => $faker->dateTimeBetween($startDate = '-30 years' , $endDate =  '-25 years'),
        'hire_date' => $faker->dateTimeBetween($startDate = '-3 months' , $endDate =  'now'),
        'iqama_exp' => $faker->dateTimeBetween($startDate = '-3 months' , $endDate =  '+10 months'),
        'iqama' => $faker->numberBetween(70000 , 80000),
        'mobile' => $faker->phoneNumber(),
        'proffesion' => $faker->word,
        'sponsorship_transfer' => $faker->name,
        'insurance' => $faker->word,
        'division' => $faker->word,
        'job_title' => $faker->word,
        'notes' => $faker->text(),
        'email' => $faker->unique()->safeEmail,
        'salary' => $faker->numberBetween(1500,3000),
        'department_id' => function(){
            return Department::all()->random();
        },
        'city_id' => function(){
            return City::all()->random();
        }
        
    ];
});
