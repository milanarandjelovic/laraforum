<?php

Route::group(['middleware' => 'auth:api'], function () {
    /* Channels routes */
    Route::post('channels/store',  'Admin\ChannelController@store');
    Route::get('channels', 'Admin\ChannelController@channels');
    Route::get('channels/{id}', 'Admin\ChannelController@show');
    Route::put('channels/{id}/update', 'Admin\ChannelController@update');
    Route::delete('channels/{id}', 'Admin\ChannelController@destroy');
});
