<?php

namespace App\Models;

use Laravolt\Indonesia\Models\Village;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Wisata extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'wisata';

    public function desa()
    {
        return $this->belongsTo(Village::class, 'code_desa', 'code');
    }
}
