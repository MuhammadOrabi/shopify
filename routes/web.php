<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('admin')->name('admin.')->group(function () {
    require __DIR__ . '/admin.php';
});


Route::prefix('vendor')->name('vendor.')->middleware('verified', 'auth', 'isVendorAdmin')->group(function () {
    require __DIR__ . '/vendor.php';
});


if (request()->segment('1') != 'admin') {
    require __DIR__ . '/front.php';
}
