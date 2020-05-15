<?php

use Illuminate\Support\Facades\Route;

Auth::routes();
Route::get('/', 'HomeController@show');
Route::get('/search/category/{category}', 'HomeController@searchCategory')->name('serach-category');
Route::get('/search/tag/{tag}', 'HomeController@searchTag')->name('serach-tag');
Route::get('/show/{product}', 'HomeController@showProduct')->name('show-product');

Route::middleware(['auth'])->group(function(){
    Route::get('users/profile', 'UsersController@edit')->name('users.edit-profile');
    Route::put('users/profile', 'UsersController@update')->name('users.update-profile');
    Route::get('/cart', 'CartsController@index')->name('cart');
    Route::get('/cart/{product}/store', 'CartsController@store')->name('cart-store');
    Route::get('/cart/{product}/remove', 'CartsController@destroy')->name('cart-remove');
});

Route::middleware(['auth','admin'])->group(function(){
    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('categories', 'CategoriesController');
    Route::get('trashed-categories','CategoriesController@trashed')->name('trashed-categories.index');
    Route::put('restore-categories/{category}','CategoriesController@restore')->name('restore-categories.update');
    Route::resource('products', 'ProductsController');
    Route::get('trashed-product','ProductsController@trashed')->name('trashed-product.index');
    Route::put('restore-product/{product}','ProductsController@restore')->name('restore-product.update');
    Route::resource('tags', 'TagsController');
    Route::get('trashed-tags','TagsController@trashed')->name('trashed-tags.index');
    Route::put('restore-tags/{tag}','TagsController@restore')->name('restore-tags.update');
    Route::get('users', 'UsersController@index')->name('users.index');
    Route::put('users/{user}/change-admin', 'UsersController@changeAdmin')->name('users.change-admin');
});
