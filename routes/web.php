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

Route::get('/user', 'UserController@index');

Route::post('/user', 'UserController@addLead');

Route::put('/user', 'UserController@assignAgent');

Route::put('/activity', 'UserController@addActivity');

Route::get('/', function () {
    return redirect('/user');
});

Route::get('/home', 'HomeController@index')->name('home');