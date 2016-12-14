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

/* FOR NON REGISTER USER */
/* Discussion routes */
Route::group(['prefix' => '/discuss'], function () {
    Route::get('/', ['as' => 'discussion.index', 'uses' => 'Forum\DiscussionController@index']);
    Route::get('/leaderboard', ['as' => 'discussion.leaderboard', 'uses' => 'Forum\DiscussionController@leaderboard']);

    /* Channels routes */
    Route::group(['prefix' => '/channels'], function () {
        Route::get('/{channelName}', ['uses' => 'Forum\ChannelController@getChannelPosts']);
    });
});

/* User profile routes */
Route::get('/@{username}', 'Forum\UserController@show');

/* Routes for login user */
Route::group(['middleware' => 'auth'], function () {
    /* Discussion routes */
    Route::group(['prefix' => 'discuss'], function () {
        Route::get('conversations/create', ['as' => 'discussion.create', 'uses' => 'Forum\DiscussionController@create']);
    });
});

/* Routes for admin user */
Route::group(['middleware' => ['auth', 'admin'], 'prefix' => 'admin'], function () {
    /* Dashboard routes */
    Route::get('/dashboard', ['as' => 'admin.dashboard', 'uses' => 'Admin\DashboardController@index']);

    /* Channels routes */
    Route::get('/channels', ['as' => 'channel.index', 'uses' => 'Admin\ChannelController@index']);

    /* User routes */
    Route::get('/users', ['as' => 'users.index', 'uses' => 'Admin\UserController@index']);

    /* Role routes */
    Route::get('/roles', ['as' => 'roles.index', 'uses' => 'Admin\RoleController@index']);

    /* Passport routes */
    Route::get('/passport', ['as' => 'passport.index', 'uses' => 'Admin\PassportController@index']);
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', 'HomeController@index');
