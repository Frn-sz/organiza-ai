<?php

use App\Http\Controllers\User\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::group(["prefix" => "user"], function () {

    Route::get('login', 'App\Http\Controllers\User\UserController@login');

    Route::post('register', 'App\Http\Controllers\User\UserController@store');

    Route::put('update/{id}', 'App\Http\Controllers\User\UserController@update');

    Route::delete('delete/{id}', 'App\Http\Controllers\User\UserController@destroy');

    Route::get('get/{id}', 'App\Http\Controllers\User\UserController@show');

    Route::get('', 'App\Http\Controllers\User\UserController@index');
});
