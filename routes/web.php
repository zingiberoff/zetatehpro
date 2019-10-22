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

Route::get('/', 'Auth\LoginController@showLoginForm');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/unconfirmed', 'GuestController@unconfirmed')->name('home');
Route::get('/test', 'HomeController@test')->name('home');
Route::resource('projects', 'ProjectController')->name('index', 'projects');
Route::get('/unconfirmed_users', 'UserController@unconfirm')->name('unconfirmed_users');
Route::get('/confirm_user/{id?}', 'UserController@confirm')->name('confirm_user');