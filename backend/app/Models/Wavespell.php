<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wavespell extends Model
{
    use HasFactory;

    protected $fillable = [
        'wavespell_number',
        'solar_seal',
        'solar_seal_es',
        'color',
        'color_es',
        'start_kin',
        'end_kin',
        'kin_count',
        'description',
        'description_es',
    ];

    public function kins()
    {
        return $this->hasMany(Kin::class, 'wavespell_id');
    }

    public function scopeByWavespellNumber($query, $wavespellNumber)
    {
        return $query->where('wavespell_number', $wavespellNumber);
    }
}
