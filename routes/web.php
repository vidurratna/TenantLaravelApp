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

use App\Services\TenantManager;

Route::group([
    'prefex'        => '/{tenant}',
    'middleware'    => \App\Http\Middleware\IdentifyTenant::class,
    'as'            => 'tenant:',
], function () {
    Route::apiResource('post', 'PostController');
    Route::get('/test', function() {
        dd(app(TenantManager::class));
    });
});

Route::apiResource('tenant', 'TenantController');
