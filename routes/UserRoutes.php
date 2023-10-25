<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::group(["prefix" => "user"], function () {

    Route::get('login', 'App\Http\Controllers\User\UserController@login')->name('login');

    Route::post('register', 'App\Http\Controllers\User\UserController@store')->name('register');

    Route::put('update/{id}', 'App\Http\Controllers\User\UserController@update')->name('update');

    Route::delete('delete/{id}', 'App\Http\Controllers\User\UserController@destroy')->name('delete');

    Route::get('get/{id}', 'App\Http\Controllers\User\UserController@show')->name('get');

    Route::get('', 'App\Http\Controllers\User\UserController@index')->name('');
});
