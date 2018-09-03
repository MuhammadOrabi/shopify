<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::middleware('auth:api-admin')->prefix('admin')->group(function () {
    Route::apiResources([
        'admins' => 'API\Admin\Admins'
    ]);
});

// Route::apiResources([])->middleware('api');
