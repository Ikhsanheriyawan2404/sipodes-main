<?php

namespace App\Http\Controllers\API\V1;

use App\Models\Umkm;
use App\Http\Resources\ApiResource;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class UmkmController extends Controller
{
    public function index()
    {
        return response()->json(new ApiResource(200, true, 'Data Umkm', Umkm::latest()->get()));
    }

    public function show($codeDesa, $umkmId)
    {
        return response()->json(new ApiResource(200, true, 'Detail Umkm', Umkm::where('code_desa', $codeDesa)->where('umkm_id', $umkmId)->get()), 200);
    }

    public function store()
    {
        $validator = Validator::make(request()->all(), [
            'code_desa' => 'required',
            'umkm_id' => 'required',
            'name' => 'required|max:255',
            'description' => 'required',
            'location' => 'required|max:255',
            'contact' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(new ApiResource(400, false, $validator->errors()), 400);
        }

        try {
            Umkm::create([
                'code_desa' => request('code_desa'),
                'umkm_id' => request('umkm_id'),
                'name' => request('name'),
                'description' => request('description'),
                'contact' => request('contact'),
                'location' => request('location'),
                'meta_description' => request('meta_description'),
                'meta_keyword' => request('meta_keyword'),
            ]);

            return response()->json(new ApiResource(201, true, 'Data umkm pusat berhasil ditambahkan'), 201);
        } catch (\Exception $e) {
            return response()->json(new ApiResource(400, false, $e->getMessage()), 400);
        }
    }

    public function update($codeDesa, $umkmId)
    {
        $validator = Validator::make(request()->all(), [
            'name' => 'required|max:255',
            'description' => 'required',
            'location' => 'required|max:255',
            'contact' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(new ApiResource(400, false, $validator->errors), 400);
        }

        $umkm = Umkm::where('code_desa', $codeDesa)->where('umkm_id', $umkmId)->first();
        if (!$umkm) {
            return response()->json('Data tidak ditemukan', 404);
        }
        try {
            $umkm->update([
                'name' => request('name'),
                'description' => request('description'),
                'location' => request('location'),
                'contact' => request('contact'),
                'meta_description' => request('meta_description'),
                'meta_keyword' => request('meta_keyword'),
            ]);
            return response()->json('Data umkm pusat berhasil diedit', 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    public function destroy($codeDesa, $umkmId)
    {
        $umkm = Umkm::where('code_desa', $codeDesa)->where('umkm_id', $umkmId)->first();
        if (!$umkm) {
            return response()->json('Berhasil tidak ditemukan', 404);
        }
        try {
            $umkm->delete();
            return response()->json('Berhasil hapus data dari pusat', 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }
}
