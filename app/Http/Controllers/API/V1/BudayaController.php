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
        $query = request('name');
        return response()->json(
            Budaya::where('name', 'like', "%$query%")
                ->with('desa.desa', 'desa.kecamatan', 'desa.kabupaten')
                ->latest()
                ->paginate(10, ['name', 'code_desa'])
        );
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
            'location' => 'required',
            'figure' => 'required|max:255',
            'contact' => 'required|max:255',
            'type_budaya' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(new ApiResource(400, false, $validator->errors()), 400);
        }

        try {
            Budaya::create([
                'code_desa' => request('code_desa'),
                'budaya_id' => request('budaya_id'),
                'name' => request('name'),
                'description' => request('description'),
                'location' => request('location'),
                'figure' => request('figure'),
                'contact' => request('contact'),
                'meta_description' => request('meta_description'),
                'meta_keyword' => request('meta_keyword'),
                'type_budaya' => request('type_budaya'),
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
            'location' => 'required',
            'figure' => 'required|max:255',
            'contact' => 'required|max:255',
            'type_budaya' => 'required|max:255',
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
                'figure' => request('figure'),
                'contact' => request('contact'),
                'meta_description' => request('meta_description'),
                'meta_keyword' => request('meta_keyword'),
                'type_budaya' => request('type_budaya'),
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
