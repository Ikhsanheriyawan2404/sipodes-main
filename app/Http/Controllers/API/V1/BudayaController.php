<?php

namespace App\Http\Controllers\API\V1;

use App\Models\Budaya;
use App\Http\Resources\ApiResource;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class BudayaController extends Controller
{
    public function index()
    {
        return response()->json(new ApiResource(200, true, 'Data Budaya', Budaya::latest()->get()));
    }

    public function show($codeDesa, $budayaId)
    {
        return response()->json(new ApiResource(200, true, 'Detail Budaya', Budaya::where('code_desa', $codeDesa)->where('budaya_id', $budayaId)->get()), 200);
    }

    public function store()
    {
        $validator = Validator::make(request()->all(), [
            'code_desa' => 'required',
            'budaya_id' => 'required',
            'name' => 'required|max:255',
            'description' => 'required',
            'location' => 'required|max:255',
            'figure' => 'required|max:255',
            'contact' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(new ApiResource(400, false, $validator->errors()), 400);
        }

        try {
            Budaya::reate([
                'code_desa' => request('code_desa'),
                'wisata_id' => request('wisata_id'),
                'name' => request('name'),
                'description' => request('description'),
                'location' => request('location'),
                'price' => request('price'),
                'figure' => request('figure'),
                'contact' => request('contact'),
                'meta_description' => request('meta_description'),
                'meta_keyword' => request('meta_keyword'),
            ]);

            return response()->json(new ApiResource(201, true, 'Data Budaya pusat berhasil ditambahkan'), 201);
        } catch (\Exception $e) {
            return response()->json(new ApiResource(400, false, $e->getMessage()), 400);
        }
    }

    public function update($codeDesa, $budayaId)
    {
        $validator = Validator::make(request()->all(), [
            'name' => 'required|max:255',
            'description' => 'required',
            'location' => 'required|max:255',
            'figure' => 'required|max:255',
            'contact' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(new ApiResource(400, false, $validator->errors), 400);
        }

        $budaya = Budaya::where('code_desa', $codeDesa)->where('budaya_id', $budayaId)->first();
        if (!$budaya) {
            return response()->json('Data tidak ditemukan', 404);
        }
        try {
            $budaya->update([
                'name' => request('name'),
                'description' => request('description'),
                'location' => request('location'),
                'figure' => 'required|max:255',
                'contact' => 'required|max:255',
                'meta_description' => request('meta_description'),
                'meta_keyword' => request('meta_keyword'),
            ]);
            return response()->json('Data budaya pusat berhasil diedit', 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    public function destroy($codeDesa, $budayaId)
    {
        $budaya = Budaya::where('code_desa', $codeDesa)->where('budaya_id', $budayaId)->first();
        if (!$budaya) {
            return response()->json('Data tidak ditemukan', 404);
        }
        try {
            $budaya->delete();
            return response()->json('Berhasil hapus data dari pusat', 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }
}
