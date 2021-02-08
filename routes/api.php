<?php

use App\Http\Controllers\Api\V1\RepositoryController as RepositoryControllerAlias;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::group(['prefix' => 'v1', 'namespace' => 'Api\\V1'], function () {
        Route::get('repositories/index', [RepositoryControllerAlias::class,'index']);
        Route::get('get-stared-repositories/{username}', [RepositoryControllerAlias::class,'get_stared_repositories']);

        Route::post('store_tag_repository',[\App\Http\Controllers\Api\V1\TagController::class,'store_tag_repository']);
});
