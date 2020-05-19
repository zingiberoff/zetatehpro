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

Route::get('/', 'SiteController@index');

Auth::routes();

Route::get('/info/{page}', function ($page) {
    return view('info.' . $page);
})->name('info')->middleware('auth');
Route::get('api/token/get', 'Auth\ApiTokenController@getToken')->middleware('auth');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/unconfirmed', 'GuestController@unconfirmed')->name('unconfirmed');
Route::get('/test', 'HomeController@test')->name('home');
Route::get('projects/{project}/status/{status?}', 'ProjectController@updateStatus');
Route::post('projects/{project}/files', 'ProjectController@saveFile');
Route::delete('projects/{project}/files/{projectFile}', 'ProjectController@deleteFile');
Route::resource('projects', 'ProjectController')->name('index', 'projects');
Route::post('projects/{project}/saveProducts', 'ProjectController@saveProducts')->name('saveProducts');
Route::get('/unconfirmed_users', 'UserController@unconfirm')->name('unconfirmed_users');
Route::get('/confirmed_users', 'UserController@confirmed')->name('confirmed_users');
Route::get('/confirm_user/{id?}', 'UserController@confirm')->name('confirm_user');


Route::get('/category/getTree', 'CatalogController@getTree')->name('getTree');
Route::get('/catalog', 'CatalogController@index')->name('catalog')->middleware('auth');
Route::get('/catalog/section/{section}', 'CatalogController@section')->name('sectionIndex')->middleware('auth');
Route::post('/product/{product}/changeCost', 'ProductController@changeCost')->middleware('role:moderator')->name('changeProductCost');
Route::get('/search', 'CatalogController@search');

Route::get('/catalog/selection', 'SelectionController@index')->name('selection');
Route::post('/catalog/selection/search', 'SelectionController@search');
