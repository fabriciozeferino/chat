<?php

Route::get('/', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/chat', 'ChatController@index');

Route::get('/messages', 'ChatController@fetchMessages');

Route::post('/messages', 'ChatController@sendMessage');

Route::get('/users', 'ChatController@users');