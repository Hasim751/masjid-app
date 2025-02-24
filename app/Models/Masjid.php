<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Masjid extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'address', 'city', 'country', 'latitude', 'longitude',
        'timezone', 'calculation_method', 'status', 'created_by'
    ];

    public function admins(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'masjid_admins');
    }

    public function prayerTimes(): HasMany
    {
        return $this->hasMany(PrayerTime::class);
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
