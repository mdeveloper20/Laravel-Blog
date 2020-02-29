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

Route::get('/', function () {
    return view('welcome');
});





Route::prefix('api')->group(function(){

    Route::post('/login','UserController@login');

    Route::post('/register','UserController@register');

    Route::post('/posts','PostController@create')->middleware('auth');
    Route::get('/posts','PostController@getAll')->middleware('auth');
    Route::get('/posts/{id}','PostController@get')->middleware('auth');
    Route::delete('/posts/{id}','PostController@delete')->middleware('auth');
    Route::put('/posts/{id}','PostController@update')->middleware('auth');

});
