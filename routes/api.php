<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\V1\{BudayaController, UmkmController, DesaController, GeneralController, WisataController, ProduksiPanganController};

Route::prefix('v1')->group(function () {
    Route::middleware('apikey')->group(function () {

        // List All Potentional
        Route::get('potensi', [GeneralController::class, 'getAllPotention']);
        Route::get('count', [GeneralController::class, 'count']);

        // Wisata
        Route::apiResource('wisata', WisataController::class)->only('index', 'store');
        Route::get('wisata/{codeDesa}/{wisataId}', [WisataController::class, 'show']);
        Route::put('wisata/{codeDesa}/{wisataId}', [WisataController::class, 'update']);
        Route::delete('wisata/{codeDesa}/{wisataId}', [WisataController::class, 'destroy']);

        // Umkm
        Route::apiResource('umkm', UmkmController::class)->only('index', 'store');
        Route::get('umkm/{codeDesa}/{umkmId}', [UmkmController::class, 'show']);
        Route::put('umkm/{codeDesa}/{umkmId}', [UmkmController::class, 'update']);
        Route::delete('umkm/{codeDesa}/{umkmId}', [UmkmController::class, 'destroy']);

        // Budaya
        Route::apiResource('budaya', BudayaController::class)->only('index', 'store');
        Route::get('budaya/{codeDesa}/{budayaId}', [BudayaController::class, 'show']);
        Route::put('budaya/{codeDesa}/{budayaId}', [BudayaController::class, 'update']);
        Route::delete('budaya/{codeDesa}/{budayaId}', [BudayaController::class, 'destroy']);

        // Produksi Pangan
        Route::apiResource('produksi-pangan', ProduksiPanganController::class)->only('index', 'store');
        Route::get('produksi-pangan/{codeDesa}/{produksiPanganId}', [ProduksiPanganController::class, 'show']);
        Route::put('produksi-pangan/{codeDesa}/{produksiPanganId}', [ProduksiPanganController::class, 'update']);
        Route::delete('produksi-pangan/{codeDesa}/{produksiPanganId}', [ProduksiPanganController::class, 'destroy']);

        // Desa
        Route::get('desa', [DesaController::class, 'index']);
        Route::get('desa/{code}', [DesaController::class, 'show']);
        Route::post('desa', [DesaController::class, 'store']);
        Route::put('desa/{code}', [DesaController::class, 'update']);
    });
});
