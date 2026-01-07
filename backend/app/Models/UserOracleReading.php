<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserOracleReading extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'kin_id',
        'oracle_data',
        'interpretation',
        'is_favorite',
    ];

    protected $casts = [
        'oracle_data' => 'array',
        'is_favorite' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kin()
    {
        return $this->belongsTo(Kin::class, 'kin_id');
    }

    public function scopeByUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    public function scopeByKin($query, $kinId)
    {
        return $query->where('kin_id', $kinId);
    }

    public function scopeFavorites($query)
    {
        return $query->where('is_favorite', true);
    }
}
