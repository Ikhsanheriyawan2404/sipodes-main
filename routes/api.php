<?php

use App\Models\Key;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\V1\DesaController;
use App\Http\Controllers\API\V1\WisataController;

Route::middleware('auth:sanctum')->group(function () {

});


Route::prefix('v1')->group(function () {
    Route::middleware('apikey')->group(function () {

        Route::apiResource('wisata', WisataController::class)->only('index', 'store');
        Route::get('wisata/{codeDesa}/{wisataId}', [WisataController::class, 'show']);
        Route::put('wisata/{codeDesa}/{wisataId}', [WisataController::class, 'update']);
        Route::delete('wisata/{codeDesa}/{wisataId}', [WisataController::class, 'destroy']);

        Route::get('desa', [DesaController::class, 'index']);
        Route::get('desa/{code}', [DesaController::class, 'show']);
        Route::post('desa', [DesaController::class, 'store']);
        Route::put('desa/{code}', [DesaController::class, 'update']);
    });
});
