<?php

namespace App\Http\Controllers\API\V1;

use App\Models\{Wisata, Desa};
use App\Http\Resources\ApiResource;
use App\Http\Controllers\Controller;
use App\Http\Requests\WisataRequest;
use Illuminate\Support\Facades\Validator;

class WisataController extends Controller
{
    public function index()
    {
        return response()->json(Wisata::with('desa')->get());
    }

    public function store()
    {
        $validator = Validator::make(request()->all(), [
            'code_desa' => 'required',
            'name' => 'required|max:255',
            'description' => 'required',
            'location' => 'required|max:255',
            'longtitude' => 'required|max:10',
            'latitude' => 'required|max:10',
            'price' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(new ApiResource(400, false, $validator->errors()), 400);
        }

        try {
            Wisata::create([
                'code_desa' => request('code_desa'),
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

    public function update($id)
    {
        $validator = Validator::make(request()->all(), [
            'code_desa' => 'required',
            'name' => 'required|max:255',
            'description' => 'required',
            'location' => 'required|max:255',
            'longtitude' => 'required|max:10',
            'latitude' => 'required|max:10',
            'price' => 'required|max:255',
        ]);

        if (!$validator->fails()) {
            return response()->json(new ApiResource(400, false, $validator->errors), 400);
        }

        $wisata = Wisata::find($id);
        try {
            $wisata->update([
                'code_desa' => request('code_desa'),
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

    public function delete($id)
    {
        $wisata = Wisata::find($id);
        try {
            $wisata->delete();
            return response()->json('Data wisata pusat berhasil dihapus', 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }
}
