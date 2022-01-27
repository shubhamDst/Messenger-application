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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::post('/save-group', 'HomeController@saveGroup')->name('save-group');
Route::get('group/{group}', 'HomeController@displayMsg')->name('display-msg');
Route::post('/save-msg', 'HomeController@addMsg')->name('save-msg');
Route::post('/delete-user-from-group', 'HomeController@deleteUser')->name('delete-user-from-group');