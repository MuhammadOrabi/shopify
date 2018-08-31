<?php

Route::get('/', function () {
    return view('front.welcome');
});

Auth::routes(['verify' => true]);


Route::middleware('verified', 'auth')->group(function () {
    Route::get('/home', 'Front\Home@index')->name('home');
});
