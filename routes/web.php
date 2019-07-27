<?php


Route::group(['middleware' => 'web'], function () {

    Route::auth();
    Auth::routes(['verify' => true]);

    Route::get('/', function () {
        return view('frontend.home');
    })->name('home');

    Route::get('/blog', function () {
        return view('frontend.blog', [
            'auth_user' => Auth::user()
        ]);
    })->name('blog');
    
    
    Route::get('/dashboard', function () {
        return view('backend.dashboard');
    });
});







