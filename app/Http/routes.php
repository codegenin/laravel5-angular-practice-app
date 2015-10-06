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
    Route::resource('dates', 'DateController', [
        'only' => ['edit', 'update', 'create', 'store']]);
    Route::get('dates', 'DateController@listDates');
    Route::get('dates/{id}', 'DateController@getDate');

    // User Routes
    Route::post('user/update', 'UserController@update');
    Route::get('users', 'UserController@index');
    Route::get('user/edit', 'UserController@edit');

    // Login And Register Routes
    Route::post('authenticate', 'AuthenticateController@authenticate');
    Route::post('register', 'AuthenticateController@register');
});
