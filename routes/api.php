<?php

Route::group(['namespace' => 'Api', 'as' => 'api.'], function () {
    
    Route::get('/posts', 'PostController@index')->name('post');
    Route::get('/posts/{post}', 'PostController@show')->name('post.show');
    Route::get('/posts/categories/{category}', 'PostController@categories')->name('categories.post');

});