<?php

/* Authentication routes */
Route::get('/login', ['as' => 'auth.login', 'uses' => 'Auth\LoginController@showLoginForm']);
Route::post('/login', ['as' => 'auth.login', 'uses' => 'Auth\LoginController@login']);
Route::get('/logout', ['as' => 'auth.logout', 'uses' => 'Auth\LoginController@logout']);

/* Registration routes */
Route::get('/register', ['as' => 'auth.register', 'uses' => 'Auth\RegisterController@showRegistrationForm']);
Route::post('/register', ['as' => 'auth.register', 'uses' => 'Auth\RegisterController@register']);

/* Password reset routes */
Route::get('password/reset/{token}', ['as' => 'auth.password.token.reset', 'uses' => 'Auth\ResetPasswordController@showResetForm']);
Route::post('password/email', ['as' => 'auth.password.email', 'uses' => 'Auth\ForgotPasswordController@sendResetLinkEmail']);
Route::get('password/reset', ['as' => 'auth.password.reset', 'uses' => 'Auth\ForgotPasswordController@showLinkRequestForm']);
Route::post('password/reset', ['as' => 'auth.password.reset', 'uses' => 'Auth\ResetPasswordController@reset']);

/* Discussion routes */
Route::get('/discuss', ['as' => 'discussion.index', 'uses' => 'Forum\DiscussionController@index']);

/* Routes for login user */
Route::group(['middleware' => 'auth'], function () {
    /* Discussion routes */
    Route::group(['prefix' => 'discuss'], function () {
        Route::get('conversations/create', ['as' => 'discussion.create', 'uses' => 'Forum\DiscussionController@create']);
    });
});

/* Routes for admin user */
Route::group(['middleware' => ['auth'], 'prefix' => 'admin'], function () {
    /* Dashboard routes */
    Route::get('dashboard', ['as' => 'admin.dashboard', 'uses' => 'Admin\DashboardController@index']);
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', 'HomeController@index');
