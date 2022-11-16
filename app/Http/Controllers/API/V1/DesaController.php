<?php

namespace App\Http\Controllers\API\V1;

use App\Models\Desa;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\ApiResource;

class DesaController extends Controller
{
    public function index()
    {
        return response()->json(new ApiResource(200, true, 'Detail Desa', Desa::with('desa', 'kecamatan')->get()), 200);
    }

    public function show($code)
    {
        $desa = Desa::with('desa', 'wisata')->where('code', $code)->first();
        if (!$desa) {
            return response()->json(new ApiResource(404, false, 'Data tidak ditemukan'), 404);
        }
        return response()->json(new ApiResource(200, true, 'Detail Desa', $desa), 200);
    }

    public function store()
    {
        $validator = Validator::make(request()->all(), [
            'url' => 'required|max:255',
            'district_code' => 'required',
            'city_code' => 'required',
            'code' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(new ApiResource(400, false, $validator->errors()), 400);
        }

        try {
            $data = Desa::create([
                'code' => request('code'),
                'district_code' => request('district_code'),
                'city_code' => request('city_code'),
                'url' => request('url'),
                'description' => request('description'),
            ]);
            return response()->json(new ApiResource(200, true, 'Berhasil menambahakan desa', $data), 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }

    }

    public function update($code)
    {
        $desa = Desa::where('code', $code)->first();
        if (!$desa) {
            return response()->json(new ApiResource(404, false, 'Data tidak ditemukan'), 404);
        }

        $validator = Validator::make(request()->all(), [
            'url' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(new ApiResource(400, false, $validator->errors()), 400);
        }

        try {
            $desa->update([
                'url' => request('url'),
                'description' => request('description'),
            ]);
            return response()->json(new ApiResource(200, true, 'Berhasil update desa', $desa), 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }
}
