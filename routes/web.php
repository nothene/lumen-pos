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

Route::group(['prefix' => 'products'], 
    function () use ($router) {
        Route::get('/{id}', 'ProductController@details');
        Route::get('/', [
            'as' => 'ProductHome',
            'uses' => 'ProductController@index'
        ]);
        Route::post('/', [
            'uses' => 'ProductController@create'
        ]);
        Route::put('/{id}', [
            'uses' => 'ProductController@update'
        ]);        
        Route::delete('/{id}', [
            'uses' => 'ProductController@delete'
        ]); 
    }
);

Route::group(['prefix' => 'recipes'], 
    function () use ($router) {
        Route::get('/{id}', 'RecipeController@getIngredient');
        Route::get('/', [
            'as' => 'RecipeHome',
            'uses' => 'RecipeController@index'
        ]);
        Route::post('/', [
            'uses' => 'RecipeController@create'
        ]);
        Route::put('/{id}', [
            'uses' => 'RecipeController@update'
        ]);        
        Route::delete('/{id}', [
            'uses' => 'RecipeController@delete'
        ]); 
    }
);    

Route::group(['prefix' => 'production'], 
    function () use ($router) {
        Route::get('/{id}', 'ProductionController@index');
        Route::get('/', [
            'as' => 'RecipeHome',
            'uses' => 'ProductionController@index'
        ]);
        Route::post('/', [
            'uses' => 'ProductionController@create'
        ]);
    }
);    

Route::group(['prefix' => 'price'], 
    function () use ($router) {
        Route::get('/', [
            'uses' => 'PriceController@index'
        ]);
        Route::post('/', [
            'uses' => 'PriceController@create'
        ]);
        Route::delete('/{id}', [
            'uses' => 'PriceController@delete'
        ]);        
    }
);    

Route::group(['prefix' => 'purchase'], 
    function () use ($router) {
        Route::get('/{id}', 'PurchaseController@detail');
        Route::get('/', [
            'uses' => 'PurchaseController@index'
        ]);
        Route::post('/', [
            'uses' => 'PurchaseController@create'
        ]);        
    }
);    

Route::group(['prefix' => 'sell'], 
    function () use ($router) {
        Route::get('/{id}', 'SellController@detail');
        Route::get('/', [
            'uses' => 'SellController@index'
        ]);
        Route::post('/', [
            'uses' => 'SellController@create'
        ]);
    }
);    
