<?php

namespace App\Http\Controllers\API\V1;

use App\Models\Wisata;
use App\Http\Controllers\Controller;

class WisataController extends Controller
{
    public function store()
    {
        request()->validate([
            'name' => 'required',
            'description' => 'required',
            'location' => 'required',
            'price' => 'required',
            'contact' => 'required',
            // 'thumbnail' => 'required',
        ]);

        try {
            Wisata::create([
                'code_desa' => request('code_desa'),
                'name' => request('name'),
                'description' => request('description'),
                'location' => request('location'),
                'price' => request('price'),
                'contact' => request('contact'),
                // 'thumbnail' => request()->file('thumbnail')->store('img/wisata'),
            ]);
            return response()->json('Data dari pusat berhasil dimasukkan', 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }

    }
}
