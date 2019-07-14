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


Route::prefix('chat')->middleware(['auth'])->group(function () {

    Route::get('/', 'ChatController@index');

    Route::get('/all', 'ChatController@all');

    Route::get('/{chat_id}', 'ChatController@show');


    Route::get('/users', 'ChatController@users');


    Route::post('/{chat_id}/message', 'MessageController@store');

    Route::get('/{chat_id}/messages', 'MessageController@getMessages');

});