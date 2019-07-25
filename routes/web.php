<?php

Route::get('/', function () {
    return view('frontend.home');
})->name('home');

Route::get('/blog', function () {
    return view('frontend.blog');
})->name('blog');

Auth::routes(['verify' => true]);

Route::get('/dashboard', function () {
    return view('backend.dashboard');
});

