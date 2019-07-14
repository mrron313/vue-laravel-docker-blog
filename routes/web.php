<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);

Route::group(['namespace' => 'Frontend', 'as' => 'frontend.', 'middleware' => 'verified'], function () {
    
    Route::get('/blog', 'HomeController@index')->name('blog');

});



