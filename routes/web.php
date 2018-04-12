<?php

Route::get('threads', 'ThreadsController@index');
Route::get('threads/{thread}', 'ThreadsController@show');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
