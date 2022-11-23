<?php

namespace App\Http\Controllers\API\V1;

use Illuminate\Support\Collection;
use App\Http\Resources\ApiResource;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\{Paginator, LengthAwarePaginator};
use App\Models\{Umkm, Budaya, Desa, Wisata, ProduksiPangan};

class GeneralController extends Controller
{
    public function getAllPotention()
    {
        $query = request('name');
        $wisata = Wisata::where('name', 'like', "%$query%")
            ->with('desa.desa', 'desa.kecamatan', 'desa.kabupaten')
            ->latest()
            ->get(['name', 'code_desa']);
        $umkm = Umkm::where('name', 'like', "%$query%")
            ->with('desa.desa', 'desa.kecamatan', 'desa.kabupaten')
            ->latest()
            ->get(['name', 'code_desa']);
        $produksiPangan = ProduksiPangan::where('name', 'like', "%$query%")
            ->with('desa.desa', 'desa.kecamatan', 'desa.kabupaten')
            ->latest()
            ->get(['name', 'code_desa']);
        $budaya = Budaya::where('name', 'like', "%$query%")
            ->with('desa.desa', 'desa.kecamatan', 'desa.kabupaten')
            ->latest()
            ->get(['name', 'code_desa', 'location']);

        $collection = collect([$wisata, $umkm, $produksiPangan, $budaya]);
        $array = $collection->collapse();

        //Getting current request link
        $actualLink = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on'
        ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        $data = $this->paginate($array, 10, request('page'), ['path' => $actualLink]);
        return response()->json($data, 200);
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

        return response()->json(new ApiResource(200, true, 'Jumlah Seluruh Data', $data), 200);
    }

    public function paginate($items, $perPage = 10, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator(
            $items->forPage($page, $perPage),
            $items->count(),
            $perPage,
            $page,
            $options
        );
    }
}
