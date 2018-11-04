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


$router->group(['middleware' => ['api'], 'namespace' => 'Api'], function($router)
{
    /*Route::get('/', 'RegisterController@index');
	Route::get('create', 'RegisterController@create');
	Route::post('store', 'RegisterController@store');
	*/
	
	
	
	//Film routes
	Route::get('films/', 'FilmController@index')->name('api.frontend.films.index');
	Route::post('films/', 'FilmController@store')->name('api.frontend.film.create');
	
	Route::get('film/{slug}', 'FilmController@show')->name('api.frontend.film.show');
	
	Route::post('film/{id}', 'FilmController@update')->name('api.frontend.film.update');
	Route::delete('film/{slug}', 'FilmController@delete')->name('api.frontend.film.delete');
	
	Route::get('comments/{id}', 'CommentController@index')->name('api.frontend.film.comments.index');
	Route::post('comments/{id}', 'CommentController@store')->name('api.frontend.film.comments.create');
	
});



