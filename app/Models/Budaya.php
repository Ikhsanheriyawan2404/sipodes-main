<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Budaya extends Model
{
    use HasFactory;

    protected $fillable = ['code_desa', 'budaya_id', 'figure', 'contact', 'name', 'meta_description', 'meta_keyword', 'location', 'description', 'tipe_budaya'];
    protected $table = 'budaya';
    protected $hidden = ['updated_at'];
    protected $casts = [
        'created_at' => 'datetime:d-m-Y',
    ];
}
