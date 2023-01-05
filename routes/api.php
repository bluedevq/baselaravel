<?php

use Illuminate\Support\Facades\Route;

Route::group(['as' => 'api.'], function () {
    Route::get('users', ['as' => 'users', 'uses' => 'UserController@index']);
    Route::post('users', ['as' => 'users.create', 'uses' => 'UserController@create']);
    Route::get('users/{id}', ['as' => 'users.detail', 'uses' => 'UserController@detail'])->where('id', '[0-9]+');
    Route::put('users/{id}', ['as' => 'users.edit', 'uses' => 'UserController@edit'])->where('id', '[0-9]+');
    Route::delete('users/{id}', ['as' => 'users.delete', 'uses' => 'UserController@delete'])->where('id', '[0-9]+');
});
