<?php

Route::auth();
Auth::routes(['verify' => true]);

Route::group(['namespace' => 'Frontend', 'as' => 'frontend.'], function () {

    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/posts', 'HomeController@posts')->name('post');    
});

Route::group(['middleware' => 'web' , 'namespace' => 'Backend', 'as' => 'backend.'], function () {

    // Dashboard
    Route::get('/dashboard', 'AdminDashboardController@index')->name('dashboard');
    
    // Blog
    Route::get('/dashboard/posts', 'AdminBlogController@index')->name('posts');
    Route::get('/dashboard/posts/{post}', 'AdminBlogController@show')->name('post.show');
    Route::put('/dashboard/posts/approve', 'AdminBlogController@approve')->name('post.approve');
});







