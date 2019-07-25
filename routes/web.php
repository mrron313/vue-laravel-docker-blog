<?php

Route::get('/', function () {
    return view('frontend.blog');
});

Auth::routes(['verify' => true]);

Route::get('/dashboard', function () {
    return view('backend.dashboard');
});

