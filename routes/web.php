<?php


Route::group(['middleware' => 'web'], function () {

    Route::auth();
    Auth::routes(['verify' => true]);

    Route::get('/', function () {
        return view('frontend.home');
    })->name('home');

    Route::get('/posts', function () {
        return view('frontend.blog', [
            'auth_user' => Auth::user()
        ]);
    })->name('post');
    
    
    Route::get('/dashboard', function () {
        return view('backend.dashboard');
    })->name('dashboard');
});







