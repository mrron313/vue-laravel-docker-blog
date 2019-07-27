<?php

Route::group(['namespace' => 'Api', 'as' => 'api.'], function () {
    
    //Posts
    Route::get('/posts', 'PostController@index')->name('post');
    Route::post('/posts', 'PostController@store')->name('post.store');
    Route::get('/posts/{post}', 'PostController@show')->name('post.show');
    Route::get('/posts/categories/{category}', 'PostController@categories')->name('categories.post');

    //Categories
    Route::get('/categories', 'CategoryController@index')->name('category');

});