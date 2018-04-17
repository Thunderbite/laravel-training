<?php

// Auth routes
Route::prefix('admin')->group(function () {
    Route::namespace('Admin')->group(function () {
        Route::redirect('/', '/admin/dashboard', 301);
    });
    Route::get('/logout', 'Auth\LoginController@logout');
    Auth::routes();
});

// Admin routes
Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => ['auth']], function () {
    // Dashboard
    Route::get('dashboard/data', 'DashboardController@data');
    Route::resource('dashboard', 'DashboardController');

    // Users
    Route::get('users/data', 'UsersController@data');
    Route::resource('users', 'UsersController');
});

Route::get('/', 'FrontendController@index');

//Test 
Route::get('/threads/{thread}', 'ThreadsController@show');
Route::get('/threads', 'ThreadsController@index');
Route::post('/threads/{thread}/replies', 'RepliesController@store');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

