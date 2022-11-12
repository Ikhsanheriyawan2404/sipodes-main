<?php

namespace App\Http\Controllers\API\V1;

use App\Models\Desa;
use App\Http\Controllers\Controller;

class DesaController extends Controller
{
    public function index()
    {
        return response()->json(Desa::get(), 200);
    }

    public function store()
    {
        try {
            $data = Desa::create([
                'code' => request('code'),
                'district_code' => request('district_code'),
                'city_code' => request('city_code'),
            ]);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
        return response()->json('Masuk', 200);
    }
}
