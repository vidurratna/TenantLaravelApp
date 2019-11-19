<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'prefex'        => '/{tenant}',
    'middleware'    => \App\Http\Middleware\IdentifyTenant::class,
    'as'            => 'tenant:',
], function () {
    Route::apiResource('posts', 'PostController');
    Route::apiResource('events', 'EventController');
});

Route::apiResource('tenants', 'TenantController');
Route::apiResource('roles', 'RoleController');
Route::post('/roles/{user}/{role}', 'RoleController@asign');
Route::post('/asign/{role}/{permission}', 'RoleController@role');
Route::apiResource('permissions', 'PermissionController');

Route::get('/test', function(){
    $x = Cache::get('user.2.permissions');
    return collect($x);
});

Route::post('/register', 'AuthController@register');
Route::post('/login', 'AuthController@login');
