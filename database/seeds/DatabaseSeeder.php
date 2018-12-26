<?php

use Illuminate\Database\Seeder;
use App\Model\City;
use App\Model\ShipmentInfo;
use App\User;
use App\Model\Warehouse;
use App\Model\Courier;
use App\Model\Department;
use App\Model\Attendance;
use App\Model\Employee;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       factory(City::class , 10)->create();
       factory(Warehouse::class , 10)->create();
       factory(Department::class , 5)->create();
       factory(User::class , 10)->create();
       factory(Courier::class , 10)->create();
       factory(ShipmentInfo::class , 30)->create();
       factory(Attendance::class , 30)->create();
       factory(Employee::class , 20)->create();

    }
}
