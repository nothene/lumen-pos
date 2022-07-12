<?php

use Illuminate\Support\Facades\Route;

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

Route::group(['prefix' => 'api'], 
    function () use ($router) {
        Route::get('/users/{id}', 'Api\UserController@index');
        Route::get('/users', [
            'as' => 'home',
            'uses' => 'Api\UserController@index'
        ]);
        Route::post('/users/create', [
            'uses' => 'Api\UserController@create'
        ]);
        Route::put('/users/update/{id}', [
            'uses' => 'Api\UserController@update'
        ]);
        Route::delete('/users/delete/{id}', [
            'uses' => 'Api\UserController@delete'
        ]); 
    });
