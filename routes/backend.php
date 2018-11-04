<?php

/*
|--------------------------------------------------------------------------
| Backend Routes
|--------------------------------------------------------------------------
|
| Here is where you can register Backend routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "backend" middleware group. Now create something great!
|
*/

$router->group(['middleware' => ['auth','isadmin'], 'namespace' => 'Backend', 'prefix' => 'backend'], function($router)
{
	
    Route::get('/', 'AdminController@index');
});
