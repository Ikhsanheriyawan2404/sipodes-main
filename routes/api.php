<?php

use App\Http\Controllers\API\V1\DesaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\V1\WisataController;

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

Route::middleware('auth:sanctum')->group(function () {

});


Route::prefix('v1')->group(function () {
    Route::apiResource('wisata', WisataController::class);

    Route::get('desa', [DesaController::class, 'index']);
    Route::post('desa', [DesaController::class, 'store']);
});
