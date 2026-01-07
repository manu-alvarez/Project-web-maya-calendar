<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Castle extends Model
{
    use HasFactory;

    protected $fillable = [
        'castle_number',
        'name',
        'name_es',
        'color',
        'color_es',
        'start_kin',
        'end_kin',
        'kin_count',
        'wavespell_count',
        'description',
        'description_es',
    ];

    public function kins()
    {
        return $this->hasMany(Kin::class, 'castle_id');
    }

    public function scopeByCastleNumber($query, $castleNumber)
    {
        return $query->where('castle_number', $castleNumber);
    }
}
