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
    require_once __DIR__ . '/admin.php';
});


Route::prefix('vendor')->name('vendor.')->middleware('verified', 'auth', 'isVendorAdmin')->group(function () {
    require_once __DIR__ . '/vendor.php';
});


if (request()->segment('1') != 'admin') {
    require_once __DIR__ . '/front.php';
}
