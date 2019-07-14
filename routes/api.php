<?php

Route::group(['namespace' => 'Api', 'as' => 'api.'], function () {
    
    Route::get('/posts', 'PostController@index')->name('post');

});