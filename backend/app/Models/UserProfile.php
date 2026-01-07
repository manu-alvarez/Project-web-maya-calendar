<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'birth_kin',
        'tone_of_birth',
        'solar_seal_of_birth',
        'color_of_birth',
        'oracle_guide',
        'oracle_analog',
        'oracle_antipode',
        'oracle_occult',
        'preferences',
    ];

    protected $casts = [
        'preferences' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function birthKin()
    {
        return $this->belongsTo(Kin::class, 'birth_kin');
    }
}
