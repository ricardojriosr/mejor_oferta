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

Route::get('/', function () {
    return view('home');
});

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

Auth::routes();

Route::get('/home', 'HomeController@index');
