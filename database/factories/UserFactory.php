<?php

use Faker\Generator as Faker;
use App\Model\Role;
use App\Model\Warehouse;
use App\Model\Department;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'is_active' => $faker->numberBetween(0 , 1),
        'email' => $faker->unique()->safeEmail,
        'id_number' => $faker->unique()->numberBetween(5000 , 6000),
        'email_verified_at' => now(),
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
        'warehouse_id' => function(){
            return Warehouse::all()->random();
        },
        'department_id' => function(){
            return Department::all()->random();
        },
        'role_id' => function(){
            return Role::all()->random();
        }
    ];
});
