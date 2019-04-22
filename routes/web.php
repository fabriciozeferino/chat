<?php


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('/chat', 'ChatController@index');

Route::get('/messages', 'ChatController@fetchMessages');

Route::post('/messages', 'ChatController@sendMessage');