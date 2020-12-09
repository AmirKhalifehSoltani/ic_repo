<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['namespace' => 'Api\v1', 'prefix' => 'v1'], function () {

    Route::post('/reg', 'icUsersController@sendEmail');
    Route::post('/vercode', 'icUsersController@verifyCode');
    Route::post('/addinfo', 'icUsersController@addMoreInfo');

    Route::post('/login', 'icUsersController@login');

    Route::post('/forgetpassreq', 'icUsersController@forgetPasswordRequest');
    Route::post('/forgetpassverify', 'icUsersController@forgetPasswordVerification');

});

Route::group(['namespace' => 'Api\v1', 'prefix' => 'v1', 'middleware' => 'api'], function () {
    Route::post('/logintoken', 'AuthController@login');
    Route::post('/logouttoken', 'AuthController@logout');
    Route::post('/refresh', 'AuthController@refresh');
    Route::post('/me', 'AuthController@me');

    Route::resource('posts', 'PostsController');
    Route::resource('cats', 'CatsController');
});

//Route::post('auth/login', 'Api\v1\AuthController@login');