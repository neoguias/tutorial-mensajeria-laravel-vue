<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->get('/users', '\App\Http\Controllers\UserController@index')->name('users');


Route::middleware('auth:sanctum')->get(
    '/messages', 
    '\App\Http\Controllers\MessageController@index'
);

Route::middleware('auth:sanctum')->post(
    '/messages', 
    '\App\Http\Controllers\MessageController@create'
);

Route::middleware('auth:sanctum')->patch(
    '/messages/{message}',
    '\App\Http\Controllers\MessageController@update'
)->withTrashed();

Route::middleware('auth:sanctum')->delete(
    '/messages/{message}',
    '\App\Http\Controllers\MessageController@delete'
);
