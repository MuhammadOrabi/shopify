<?php

Route::get('/', function () {
    return redirect('/vendor/dashboard');
});

Route::get('/dashboard', function () {
    dd('vendor.dashboard');
});

