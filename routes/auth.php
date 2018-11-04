<?php

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
|
| Here is where you can register Auth routes for your application. These
| routes are loaded by the RouteServiceProvider. Now create something great!
|
*/

$router->group(['namespace' => 'Auth'], function($router)
{
    Route::get('/register', 'RegisterController@index');
	Route::post('register', 'RegisterController@create');
	
	
	Route::get('/login', 'LoginController@showLoginForm')->name('login');
	Route::post('login', 'LoginController@login');
	Route::get('logout', 'LoginController@logout');
	
});
