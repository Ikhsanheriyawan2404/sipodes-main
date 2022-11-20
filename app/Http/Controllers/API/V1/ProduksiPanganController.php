<?php

namespace App\Http\Controllers\API\V1;

use App\Models\ProduksiPangan;
use App\Http\Resources\ApiResource;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ProduksiPanganController extends Controller
{
    public function index()
    {
        $query = request('name');
        return response()->json(new ApiResource(200, true, 'Data Produksi Pangan', ProduksiPangan::where('name', 'like', "%$query%")->with('desa')->latest()->get()));
    }

    public function show($codeDesa, $produksiPanganId)
    {
        return response()->json(new ApiResource(200, true, 'Detail produksi_pangan', ProduksiPangan::where('code_desa', $codeDesa)->where('produksi_pangan_id', $produksiPanganId)->get()), 200);
    }

    public function store()
    {
        $validator = Validator::make(request()->all(), [
            'code_desa' => 'required',
            'produksi_pangan_id' => 'required',
            'name' => 'required|max:255',
            'description' => 'required',
            'location' => 'required|max:255',
            'contact' => 'required|max:255',
            'type_produksi_pangan' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(new ApiResource(400, false, $validator->errors()), 400);
        }

        try {
            ProduksiPangan::create([
                'code_desa' => request('code_desa'),
                'produksi_pangan_id' => request('produksi_pangan_id'),
                'name' => request('name'),
                'description' => request('description'),
                'contact' => request('contact'),
                'location' => request('location'),
                'meta_description' => request('meta_description'),
                'meta_keyword' => request('meta_keyword'),
                'type_produksi_pangan' => request('type_produksi_pangan'),
            ]);

            return response()->json(new ApiResource(201, true, 'Data Produksi Pangan pusat berhasil ditambahkan'), 201);
        } catch (\Exception $e) {
            return response()->json(new ApiResource(400, false, $e->getMessage()), 400);
        }
    }

    public function update($codeDesa, $produksiPanganId)
    {
        $validator = Validator::make(request()->all(), [
            'name' => 'required|max:255',
            'description' => 'required',
            'location' => 'required|max:255',
            'contact' => 'required|max:255',
            'type_produksi_pangan' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(new ApiResource(400, false, $validator->errors), 400);
        }

        $produksi_pangan = ProduksiPangan::where('code_desa', $codeDesa)->where('produksi_pangan_id', $produksiPanganId)->first();
        if (!$produksi_pangan) {
            return response()->json('Data tidak ditemukan', 404);
        }
        try {
            $produksi_pangan->update([
                'name' => request('name'),
                'description' => request('description'),
                'location' => request('location'),
                'contact' => request('contact'),
                'meta_description' => request('meta_description'),
                'meta_keyword' => request('meta_keyword'),
                'type_produksi_pangan' => request('type_produksi_pangan'),
            ]);
            return response()->json('Data produksi pangan pusat berhasil diedit', 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    public function destroy($codeDesa, $produksiPanganId)
    {
        $produksi_pangan = ProduksiPangan::where('code_desa', $codeDesa)->where('produksi_pangan_id', $produksiPanganId)->first();
        if (!$produksi_pangan) {
            return response()->json('Berhasil tidak ditemukan', 404);
        }
        try {
            $produksi_pangan->delete();
            return response()->json('Berhasil hapus data dari pusat', 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }
}
