<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/


//Backend Routes
Route::get('/', function () {
    return view('home');
});
//Frontend Routes
Route::get('/home', 'HomeController@index');

//Ajax Routes
Route::get('/subcategories/ajax/{id}',[
    'uses'  => 'SubcategoryController@fill_subcategories',
    'as'    => 'subcategory.ajax'
]);
Route::get('offers/search/{id}', [
    'uses'  => 'OfferController@search',
    'as'    => 'offers.search'
]);

Route::group(['prefix' => 'admin','middleware' => 'auth'], function() {
    Route::resource('categories', 'CategoryController');
    Route::get('categories/{id}/destroy', [
        'uses'  => 'CategoryController@destroy',
        'as'    => 'categories.delete'
    ]);
    Route::resource('subcategories', 'SubcategoryController');
    Route::get('subcategories/{id}/destroy', [
        'uses'  => 'SubcategoryController@destroy',
        'as'    => 'subcategories.delete'
    ]);
    Route::resource('articles', 'ArticleController');
    Route::get('articles/{id}/destroy', [
        'uses'  => 'ArticleController@destroy',
        'as'    => 'articles.delete'
    ]);
    Route::resource('conditions', 'ConditionController');
    Route::get('conditions/{id}/destroy', [
        'uses'  => 'ConditionController@destroy',
        'as'    => 'conditions.delete'
    ]);
    Route::resource('offers', 'OfferController');
    Route::get('offers/{id}/destroy', [
        'uses'  => 'OfferController@destroy',
        'as'    => 'offers.delete'
    ]);
});
//Auth Routes
Auth::routes();
