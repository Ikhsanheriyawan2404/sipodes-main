<?php

namespace App\Models;

use Laravolt\Indonesia\Models\{City, Village, District};
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Desa extends Model
{
    use HasFactory;

    protected $table = 'desa';
    protected $fillable = ['code', 'url', 'description', 'district_code', 'city_code'];
    protected $hidden = ['created_at', 'updated_at'];

    public function desa()
    {
        return $this->hasOne(Village::class, 'code', 'code');
    }

    public function wisata()
    {
        return $this->hasMany(Wisata::class, 'code_desa', 'code');
    }

    public function kecamatan()
    {
        return $this->belongsTo(District::class, 'district_code', 'code');
    }

    public function kabupaten()
    {
        return $this->belongsTo(City::class, 'city_code', 'code');
    }
}
