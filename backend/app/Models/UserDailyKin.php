<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDailyKin extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'date',
        'kin_id',
        'wavespell_id',
        'castle_id',
        'is_viewed',
        'viewed_at',
        'oracle_data',
        'notes',
    ];

    protected $casts = [
        'date' => 'date',
        'is_viewed' => 'boolean',
        'viewed_at' => 'datetime',
        'oracle_data' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kin()
    {
        return $this->belongsTo(Kin::class, 'kin_id');
    }

    public function wavespell()
    {
        return $this->belongsTo(Wavespell::class, 'wavespell_id');
    }

    public function castle()
    {
        return $this->belongsTo(Castle::class, 'castle_id');
    }

    public function scopeByUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    public function scopeByDate($query, $date)
    {
        return $query->where('date', $date);
    }

    public function scopeViewed($query)
    {
        return $query->where('is_viewed', true);
    }
}
