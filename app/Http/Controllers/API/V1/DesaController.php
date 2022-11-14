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
        return response()->json(Desa::with('desa', 'kecamatan', 'wisata')->get(), 200);
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
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
        return response()->json('Masuk', 200);
    }
}
