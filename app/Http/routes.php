<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('index');
});

/**
 * API Routes
 */
Route::group(['prefix' => 'api/v1'], function()
{
    // Dates Routes
    Route::get('dates', 'DateController@getListDates');
    Route::get('dates/{id}', 'DateController@getDate');

    // User Routes
    Route::post('user/update', 'UserController@updateUser');
    Route::get('users', 'UserController@getUsers');
    Route::get('user/edit', 'UserController@editUser');
    Route::get('users/{id}', 'UserController@getUser');

    // Login And Register Routes
    Route::post('authenticate', 'AuthenticateController@authenticate');
    Route::post('register', 'AuthenticateController@register');
});
