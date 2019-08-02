<?php

Route::group(['namespace' => 'Api', 'as' => 'api.'], function () {
    
    //Posts
    Route::get('/posts', 'PostController@index')->name('post');
    Route::post('/posts', 'PostController@store')->name('post.store');
    Route::get('/posts/{post}', 'PostController@show')->name('post.show');
    Route::get('/posts/categories/{category}', 'PostController@categoryPosts')->name('categories.post');

    // Single User Posts    
    Route::get('/{user}/posts/', 'PostController@singleUserPosts')->name('post.singleuser');

    //Categories
    Route::get('/categories', 'CategoryController@index')->name('category');

    // User Profile
    Route::get('/user/edit/{token}', 'UserController@edit')->name('user.edit');
    Route::put('/user/update', 'UserController@update')->name('user.update');

    // User Password
    Route::put('/user/password/update', 'UserController@updatePassword')->name('user.password.update');

});