<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});
// admin routes
Route::group(['namespace' => 'Admin', 'middleware' => 'admin'], function (){
    // Users Routes
    Route::get('/', 'UsersController@index')->name('admin.users');
    Route::get('/users', 'UsersController@index')->name('admin.users');
    Route::get('/users/create', 'UsersController@create')->name('admin.users.create');
    Route::post('/users/create', 'UsersController@store')->name('admin.users.store');
    Route::get('/users/edit/{user_id}', 'UsersController@edit')->name('admin.users.edit');
    Route::post('/users/edit/{user_id}', 'UsersController@doEdit')->name('admin.users.doEdit');
    Route::get('/users/delete/{user_id}', 'UsersController@delete')->name('admin.users.delete');

    // Devices Routes
//    Route::get('/', 'DevicesController@index')->name('admin.devices');
    Route::get('/devices', 'DevicesController@index')->name('admin.devices');
    Route::get('/devices/create', 'DevicesController@create')->name('admin.devices.create');
    Route::post('/devices/create', 'DevicesController@store')->name('admin.devices.store');
    Route::get('/devices/edit/{device_id}', 'DevicesController@edit')->name('admin.devices.edit');
    Route::post('/devices/edit/{device_id}', 'DevicesController@doEdit')->name('admin.devices.doEdit');
    Route::get('/devices/delete/{device_id}', 'DevicesController@delete')->name('admin.devices.delete');
});

Route::group(['namespace' => 'Frontend', 'middleware' => 'auth'], function (){
    Route::get('/notverified', 'UsersController@notVerified')->name('notVerified');
});

// Frontend routes
Route::group(['namespace' => 'Frontend', 'middleware' => ['auth', 'phoneVerified']], function (){
    // device commands
    Route::get('mydevices', 'DevicesController@list')->name('frontend.mydevices');
    Route::get('mydevice/{device_id}', 'DevicesController@single')->name('frontend.mysingledevice');
    Route::post('mydevice/sendcmd', 'DevicesController@sendcmd')->name('frontend.sendcmd');
    Route::post('mydevice/getstatus', 'DevicesController@getstatus')->name('frontend.getstatus');

    // device management
    Route::get('mydeviceslist', 'DevicesController@index')->name('frontend.devices');
    Route::get('mydevices/create', 'DevicesController@create')->name('frontend.devices.create');
    Route::post('mydevices/create', 'DevicesController@store')->name('frontend.devices.store');
    Route::get('mydevices/edit/{device_id}', 'DevicesController@edit')->name('frontend.devices.edit');
    Route::post('mydevices/edit/{device_id}', 'DevicesController@doEdit')->name('frontend.devices.doEdit');
    Route::get('mydevices/delete/{device_id}', 'DevicesController@delete')->name('frontend.devices.delete');
});

// login routes
Route::group(['namespace' => 'Frontend'], function (){
//    Route::get('/login', 'UsersController@login')->name('login');
    Route::get('/registeration', 'UsersController@registeration')->name('registeration');
    Route::get('/logout', 'UsersController@logout')->name('logout');
//    Route::post('/login', 'UsersController@dologin')->name('dologin');
    Route::post('/registeration', 'UsersController@register')->name('doregisteration');
    Route::get('/verification/{uid}', 'UsersController@verification')->name('verification');
    Route::post('/verification/{uid}', 'UsersController@doverification')->name('doverification');
    Route::get('/signin', 'UsersController@signin')->name('signin');
    Route::post('/signin', 'UsersController@dosignin')->name('dosignin');


    Route::get('/test', function (){
        return view('test');
    })->name('test');
});
