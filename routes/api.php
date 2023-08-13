<?php

use App\Http\Controllers\Api\DocumentController;
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

require __DIR__ . '/auth.php';



Route::group(['middleware' => ['auth:sanctum']], function () {
   
    Route::group(['prefix' => 'document'], function () {
        Route::get('/', [DocumentController::class, 'index']);
        Route::post('/', [DocumentController::class, 'store']);
        Route::post('/{document}', [DocumentController::class, 'update']);
    });


    Route::group(['prefix' => 'document-version'], function () {
        Route::get('/', [UserIndustriesController::class, 'index']);
        Route::post('/', [UserIndustriesController::class, 'store']);
        Route::patch('/', [UserIndustriesController::class, 'update']);
    });
});