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

    Route::post('/categories/restore/{id}', 'API\Admin\CategoriesController@restore');
    Route::post('/categories/force-delete/{id}', 'API\Admin\CategoriesController@forceDelete');
    Route::apiResources([
        'admins' => 'API\Admin\AdminsController',
        'categories' => 'API\Admin\CategoriesController',
        'items' => 'API\Admin\ItemsController',
        'media' => 'API\Admin\MediaController',
    ]);
});

