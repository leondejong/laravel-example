<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', 'Feature\DashboardController@index')->name('home');
Route::get('/dashboard', 'Feature\DashboardController@index')->name('dashboard');

Route::get('user', 'Feature\UserController@edit')->name('user');
Route::match(['put', 'patch'], 'user', 'Feature\UserController@update')->name('user.update');
Route::delete('user', 'Feature\UserController@remove')->name('user.remove');

Route::resource('collection', 'Feature\CollectionController');
