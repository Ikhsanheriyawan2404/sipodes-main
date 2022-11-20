<?php

namespace App\Models;

use App\Models\Desa;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProduksiPangan extends Model
{
    use HasFactory;

    protected $fillable = ['code_desa', 'produksi_pangan_id', 'location', 'contact','name', 'meta_description', 'type_produksi_pangan','meta_keyword', 'description'];
    protected $table = 'produksi_pangan';
    protected $hidden = ['updated_at'];
    protected $casts = [
        'created_at' => 'datetime:d-m-Y',
    ];

    public function desa()
    {
        return $this->belongsTo(Desa::class, 'code_desa', 'code');
    }
}
