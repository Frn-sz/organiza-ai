<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(["prefix" => "task"], function () {

    Route::post("create", 'App\Http\Controllers\Task\TaskController@store')->middleware('auth:sanctum')->name("create_task");

    Route::put("update/{id}", 'App\Http\Controllers\Task\TaskController@update')->middleware('auth:sanctum')->name("update_task");

    Route::delete("delete/{task_id}", "'App\Http\Controllers\Task\TaskController@destroy'")->middleware('auth:sanctum')->name("delete_task");

    Route::get("{task_id}", 'App\Http\Controllers\Task\TaskController@show')->middleware('auth:sanctum')->name("show_task");

    Route::get("", 'App\Http\Controllers\Task\TaskController@index')->middleware('auth:sanctum')->name('get_task');
});
