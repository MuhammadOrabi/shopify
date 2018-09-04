<?php

Route::middleware('auth:web-admin')->group(function () {
    Route::get('/', function () {
        return redirect('/admin/dashboard');
    });

    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    });

    Route::post('/logout', 'Admin\Auth\LoginController@logout')->name('logout');

    Route::resource('admins', 'Admin\AdminsController');
});

Route::get('/login', 'Admin\Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'Admin\Auth\LoginController@login')->name('login');

Route::get('/password/reset', 'Admin\Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('/password/email', 'Admin\Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');

Route::get('/password/reset/{token}', 'Admin\Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('/password/reset', 'Admin\Auth\ResetPasswordController@reset')->name('password.update');

