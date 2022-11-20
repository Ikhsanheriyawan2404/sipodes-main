<?php

namespace App\Models;

use App\Models\Desa;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Umkm extends Model
{
    use HasFactory;

    protected $fillable = ['code_desa', 'umkm_id','type_umkm', 'name', 'meta_description', 'meta_keyword', 'location', 'description', 'contact'];
    protected $table = 'umkm';
    protected $hidden = ['updated_at'];
    protected $casts = [
        'created_at' => 'datetime:d-m-Y',
    ];

    public function desa()
    {
        return $this->belongsTo(Desa::class, 'code_desa', 'code');
    }
}
