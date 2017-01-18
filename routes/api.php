<?php

/* Search routes */
//Route::get('/search/{search}', 'SearchController@index');

Route::group(['middleware' => 'auth:api', 'prefix' => 'admin'], function () {
    /* Channels routes */
    Route::post('channels/store', 'Admin\ChannelController@store');
    Route::get('channels', 'Admin\ChannelController@channels');
    Route::get('channels/{id}', 'Admin\ChannelController@show');
    Route::put('channels/{id}/update', 'Admin\ChannelController@update');
    Route::delete('channels/{id}', 'Admin\ChannelController@destroy');

    /* Users routes */
    Route::get('users/', 'Admin\UserController@users');

    /* Roles routes */
    Route::post('roles/store', 'Admin\RoleController@store');
    Route::get('roles', 'Admin\RoleController@roles');
    Route::get('roles/{id}', 'Admin\RoleController@show');
    Route::put('roles/{id}/update', 'Admin\RoleController@update');
    Route::delete('roles/{id}', 'Admin\RoleController@destroy');
});

Route::group(['middleware' => 'auth:api', 'prefix' => 'forum'], function () {
    /* Users routes */
    Route::get('/{username}', 'Forum\UserController@showUser');
    Route::put('/{username}/update', 'Forum\UserController@update');

    /* Comment Vote routes */
    Route::get('/comments/{comment}/votes', 'Forum\CommentController@show');
    Route::post('/comments/{comment}/votes', 'Forum\CommentController@create');
    Route::delete('/comments/{comment}/votes', 'Forum\CommentController@remove');
});