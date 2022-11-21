<?php

namespace App\Http\Controllers\API\V1;

use App\Models\{Wisata};
use App\Http\Resources\ApiResource;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class WisataController extends Controller
{
    public function index()
    {
        $query = request('name');
        return response()->json(Wisata::where('name', 'like', "%$query%")->with('desa.desa', 'desa.kecamatan', 'desa.kabupaten')->latest()->paginate(10, ['name', 'code_desa']));
    }

    public function show($codeDesa, $wisataId)
    {
        return response()->json(new ApiResource(200, true, 'Detail Wisata', Wisata::where('code_desa', $codeDesa)->where('wisata_id', $wisataId)->get()), 200);
    }

    public function store()
    {
        $validator = Validator::make(request()->all(), [
            'code_desa' => 'required',
            'wisata_id' => 'required',
            'name' => 'required|max:255',
            'description' => 'required',
            'location' => 'required',
            'longtitude' => 'required',
            'latitude' => 'required',
            'price' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(new ApiResource(400, false, $validator->errors()), 400);
        }

        try {
            Wisata::create([
                'code_desa' => request('code_desa'),
                'wisata_id' => request('wisata_id'),
                'name' => request('name'),
                'description' => request('description'),
                'location' => request('location'),
                'price' => request('price'),
                'longtitude' => request('longtitude'),
                'latitude' => request('latitude'),
                'meta_description' => request('meta_description'),
                'meta_keyword' => request('meta_keyword'),
            ]);

            return response()->json(new ApiResource(201, true, 'Data wisata pusat berhasil ditambahkan'), 201);
        } catch (\Exception $e) {
            return response()->json(new ApiResource(400, false, $e->getMessage()), 400);
        }
    }

    public function update($codeDesa, $wisataId)
    {
        $validator = Validator::make(request()->all(), [
            'name' => 'required|max:255',
            'description' => 'required',
            'location' => 'required',
            'longtitude' => 'required',
            'latitude' => 'required',
            'price' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(new ApiResource(400, false, $validator->errors), 400);
        }

        $wisata = Wisata::where('code_desa', $codeDesa)->where('wisata_id', $wisataId)->first();
        if (!$wisata) {
            return response()->json('Data tidak ditemukan', 404);
        }
        try {
            $wisata->update([
                'name' => request('name'),
                'description' => request('description'),
                'location' => request('location'),
                'price' => request('price'),
                'longtitude' => request('longtitude'),
                'latitude' => request('latitude'),
                'meta_description' => request('meta_description'),
                'meta_keyword' => request('meta_keyword'),
            ]);
            return response()->json('Data wisata pusat berhasil diedit', 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    public function destroy($codeDesa, $wisataId)
    {
        $wisata = Wisata::where('code_desa', $codeDesa)->where('wisata_id', $wisataId)->first();
        if (!$wisata) {
            return response()->json('Berhasil tidak ditemukan', 404);
        }
        try {
            $wisata->delete();
            return response()->json('Berhasil hapus data dari pusat', 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }
}
