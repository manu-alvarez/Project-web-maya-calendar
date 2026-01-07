<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kin extends Model
{
    use HasFactory;

    protected $fillable = [
        'kin_number',
        'solar_seal',
        'solar_seal_es',
        'galactic_tone',
        'galactic_tone_name',
        'color',
        'color_es',
        'power',
        'power_es',
        'action',
        'action_es',
        'essence',
        'essence_es',
        'description',
        'description_es',
        'is_gap',
        'is_core_day',
        'wavespell_id',
        'castle_id',
    ];

    protected $casts = [
        'is_gap' => 'boolean',
        'is_core_day' => 'boolean',
    ];

    public function wavespell()
    {
        return $this->belongsTo(Wavespell::class, 'wavespell_id');
    }

    public function castle()
    {
        return $this->belongsTo(Castle::class, 'castle_id');
    }

    public function dailyKins()
    {
        return $this->hasMany(UserDailyKin::class);
    }

    public function oracleReadings()
    {
        return $this->hasMany(UserOracleReading::class);
    }

    public function scopeByKinNumber($query, $kinNumber)
    {
        return $query->where('kin_number', $kinNumber);
    }

    public function scopeByWavespell($query, $wavespellId)
    {
        return $query->where('wavespell_id', $wavespellId);
    }

    public function scopeByCastle($query, $castleId)
    {
        return $query->where('castle_id', $castleId);
    }

    public function scopeGaps($query)
    {
        return $query->where('is_gap', true);
    }

    public function scopeCoreDays($query)
    {
        return $query->where('is_core_day', true);
    }
}
