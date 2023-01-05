<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth:backend'], 'as' => 'backend.'], function () {
    // logout
    Route::post('logout', 'Auth\LoginController@logout')->name('logout');

    // home
    Route::get('/', ['as' => 'home', 'uses' => 'HomeController@index']);

    // users
    Route::resource('users', 'UsersController');
    Route::get('users', ['as' => 'users.index', 'uses' => 'UsersController@index']);
    Route::get('users/create', ['as' => 'users.create', 'uses' => 'UsersController@create']);
    Route::post('users', ['as' => 'users.store', 'uses' => 'UsersController@store']);
    Route::get('users/{user}/edit', ['as' => 'users.edit', 'uses' => 'UsersController@edit'])->where('user', '[0-9]+');
    Route::put('users/{user}', ['as' => 'users.update', 'uses' => 'UsersController@update'])->where('user', '[0-9]+');
    Route::get('users/{user}', ['as' => 'users.show', 'uses' => 'UsersController@show'])->where('user', '[0-9]+');
    Route::delete('users/{user}', ['as' => 'users.destroy', 'uses' => 'UsersController@destroy'])->where('user', '[0-9]+');
    Route::post('users/valid', ['as' => 'users.valid', 'uses' => 'UsersController@valid']);
    Route::get('users/confirm', ['as' => 'users.confirm', 'uses' => 'UsersController@confirm']);
    Route::get('users/download-csv', ['as' => 'users.downloadCsv', 'uses' => 'UsersController@downloadCsv']);
});

// login
Route::get('login', ['as' => 'backend.login', 'uses' => 'Auth\LoginController@showLoginForm']);
Route::post('login', ['as' => 'backend.post_login', 'uses' => 'Auth\LoginController@login']);
