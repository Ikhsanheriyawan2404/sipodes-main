<?php

namespace App\Models;

use App\Models\Desa;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Budaya extends Model
{
    use HasFactory;

    protected $fillable = ['code_desa', 'budaya_id', 'figure', 'contact', 'name', 'meta_description', 'meta_keyword', 'location', 'description', 'type_budaya'];
    protected $table = 'budaya';
    protected $hidden = ['updated_at'];
    protected $casts = [
        'created_at' => 'datetime:d-m-Y',
    ];

    public function desa()
    {
        return $this->belongsTo(Desa::class, 'code_desa', 'code');
    }
}
