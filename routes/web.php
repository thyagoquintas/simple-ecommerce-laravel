<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Route::middleware('auth')->group(function(){
    Route::resource('categories', 'CategoriesController');
    Route::get('trashed-categories','CategoriesController@trashed')->name('trashed-categories.index');
    Route::put('restore-categories/{category}','CategoriesController@restore')->name('restore-categories.update');
    Route::resource('products', 'ProductsController');
    Route::get('trashed-product','ProductsController@trashed')->name('trashed-product.index');
    Route::put('restore-product/{product}','ProductsController@restore')->name('restore-product.update');
    Route::resource('tags', 'TagsController');
    Route::get('trashed-tags','TagsController@trashed')->name('trashed-tags.index');
    Route::put('restore-tags/{tag}','TagsController@restore')->name('restore-tags.update');
});