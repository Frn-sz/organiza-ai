<?php

use App\Http\Controllers\User\UserController as UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::group(["prefix" => "user"], function () {

    Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
        return $request->user();
    });

    Route::get('', 'App\Http\Controllers\User\UserController@index');

    Route::get('{id}', 'App\Http\Controllers\User\UserController@show');

    Route::post('register', 'App\Http\Controllers\User\UserController@store');

    Route::put('update/{id}', 'App\Http\Controllers\User\UserController@update');

    Route::delete('delete/{id}', 'App\Http\Controllers\User\UserController@destroy');
});
