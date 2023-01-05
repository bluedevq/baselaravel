<?php

use Illuminate\Support\Facades\Route;

Route::get('/', ['uses' => 'HomeController@index'])->name('frontend.home');
