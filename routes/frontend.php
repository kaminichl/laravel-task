<?php

/*
|--------------------------------------------------------------------------
| Frontend Routes
|--------------------------------------------------------------------------
|
| Here is where you can register frontend routes for your application. These
| routes are loaded by the RouteServiceProvider. Now create something great!
|
*/

$router->group(['namespace' => 'Frontend'], function($router)
{
     Route::get('/films', 'FilmController@index');
});
