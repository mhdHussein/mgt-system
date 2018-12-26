<?php

Route::resource('/city', 'CityController');
Route::resource('/warehouse', 'WarehouseController');
Route::resource('/courier', 'CourierController');
Route::get('/courier/supervisor/{id}', 'CourierController@supervisor_couriers');
Route::resource('/package', 'ShipmentInfoController');
Route::resource('/department', 'DepartmentController');
Route::resource('/attendance', 'AttendanceController');
Route::resource('/employee', 'EmployeeController');

// reports

Route::get('/package/supervisor/{id}', 'ShipmentInfoController@supervisor_packages');
Route::get('/package/courier/{id}', 'ShipmentInfoController@courier_packages');

// supervisor productivity {please pass the user_id of the supervisor}
Route::get('/package/productivity/{id}', 'ShipmentInfoController@supervisor_productivity');

//attendance

Route::get('/attendance/supervisor/{id}', 'AttendanceController@supervisor_attandance');
Route::get('/attendance/courier/{id}', 'AttendanceController@courier_attandance');

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');
    Route::post('update/{id}', 'AuthController@update');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

});