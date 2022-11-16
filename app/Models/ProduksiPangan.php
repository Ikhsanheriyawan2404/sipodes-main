<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProduksiPangan extends Model
{
    use HasFactory;


    protected $fillable = ['name', 'meta_description', 'meta_keyword', 'description'];
    protected $table = 'produksi_pangan';
    protected $hidden = ['updated_at'];
    protected $casts = [
        'created_at' => 'datetime:d-m-Y',
    ];
}
