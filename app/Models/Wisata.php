<?php

namespace App\Models;

use Laravolt\Indonesia\Models\Village;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Wisata extends Model
{
    use HasFactory;

    protected $fillable = ['code_desa', 'wisata_id', 'name', 'slug', 'meta_description', 'meta_keyword', 'thumbnail', 'location', 'price', 'description', 'latitude', 'longtitude'];

    protected $table = 'wisata';

    public function desa()
    {
        return $this->belongsTo(Village::class, 'code_desa', 'code');
    }
}
