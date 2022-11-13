<?php

namespace App\Models;

use Laravolt\Indonesia\Models\Village;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Desa extends Model
{
    use HasFactory;

    protected $table = 'desa';
    protected $fillable = ['code', 'name', 'district_code', 'city_code'];
    protected $hidden = ['created_at', 'updated_at'];

    public function desa()
    {
        return $this->hasOne(Village::class, 'code', 'code');
    }

    public function wisata()
    {
        return $this->hasMany(Wisata::class, 'code_desa', 'code');
    }
}
