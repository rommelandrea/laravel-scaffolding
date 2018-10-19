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
    return view('home');
});

Route::get('/login/social/{social}', 'AuthenticationController@social')->name('social');
Route::get('/login/social/{social}/confirmation', 'AuthenticationController@socialConfirmation')->name('social.confirmation');

Route::group(['middleware' => ['guest']], function () {
    Route::get('/login', 'AuthenticationController@index')->name('login');
});

Route::group(['middleware' => ['authenticated']], function () {
    Route::get('/logout', 'AuthenticationController@logout')->name('logout');
});
