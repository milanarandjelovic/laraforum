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


Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', 'HomeController@index');
