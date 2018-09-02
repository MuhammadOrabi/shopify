<?php

Route::middleware('auth:web-admin')->group(function () {
    Route::get('/', function () {
        return redirect('/admin/dashboard');
    });

    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    });

    Route::post('/logout', 'Admin\Auth\Login@logout')->name('logout');

    Route::resource('admins', 'Admin\Admins');
});

Route::get('/login', 'Admin\Auth\Login@showLoginForm')->name('login');
Route::post('/login', 'Admin\Auth\Login@login')->name('login');

Route::get('/password/reset', 'Admin\Auth\ForgotPassword@showLinkRequestForm')->name('password.request');
Route::post('/password/email', 'Admin\Auth\ForgotPassword@sendResetLinkEmail')->name('password.email');

Route::get('/password/reset/{token}', 'Admin\Auth\ResetPassword@showResetForm')->name('password.reset');
Route::post('/password/reset', 'Admin\Auth\ResetPassword@reset')->name('password.update');


// Route::post('/password/email', 'Admin\Auth\ResetPassword@showResetForm')->name('password.update');
