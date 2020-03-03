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


Route::post('login','UserController@login');

Route::post('register','UserController@register');


Route::prefix('posts')->middleware('auth')->group(function(){


    Route::get('/','PostController@getAll');
    Route::get('/{id}','PostController@get');
    Route::post('/','PostController@create');
    Route::delete('/{id}','PostController@delete');
    Route::put('/{id}','PostController@update');

});

Route::prefix('users')->middleware('adminAuth')->group(function(){


    Route::get('/','UserController@getAll');
    Route::get('/{id}','UserController@get');
    Route::post('/','UserController@create');
    Route::delete('/{id}','UserController@delete');
    Route::put('/{id}','UserController@update');

});


