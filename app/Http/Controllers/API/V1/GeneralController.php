<?php

namespace App\Http\Controllers\API\V1;

use App\Models\{Umkm, Budaya, Desa, Wisata, ProduksiPangan};
use App\Http\Resources\ApiResource;
use App\Http\Controllers\Controller;

class GeneralController extends Controller
{
    public function getAllPotention()
    {
        $query = request('name');
        $wisata = Wisata::where('name', 'like', "%$query%")->with('desa')->inRandomOrder()->get(['name', 'description', 'code_desa', 'location', 'created_at']);
        $umkm = Umkm::where('name', 'like', "%$query%")->with('desa')->inRandomOrder()->get(['name', 'description', 'code_desa', 'location', 'created_at']);
        $produksi_pangan = ProduksiPangan::where('name', 'like', "%$query%")->with('desa')->inRandomOrder()->get(['name', 'description', 'code_desa', 'location', 'created_at']);
        $budaya = Budaya::where('name', 'like', "%$query%")->with('desa')->inRandomOrder()->get(['name', 'description', 'code_desa', 'location', 'created_at']);

        $collection = collect([$wisata, $umkm, $produksi_pangan, $budaya]);

        $data = $collection->collapse();
        return response()->json(new ApiResource(200, true, 'List Potensi', $data), 200);
    }

    public function count()
    {
        $data = [
            'total_wisata' => Wisata::count(),
            'total_budaya' => Budaya::count(),
            'total_umkm' => Umkm::count(),
            'total_produksi_pangan' => ProduksiPangan::count(),
            'total_desa' => Desa::count(),
        ];

        return response()->json(new ApiResource(200, true, 'Jumlah Seluruh Potensi', $data),200);
    }
}
