<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PrayerTime extends Model
{
    use HasFactory;

    protected $fillable = [
        'masjid_id', 'date', 'fajr', 'fajr_jamath', 'zuhr', 'zuhr_jamath',
        'asr', 'asr_jamath', 'maghrib', 'maghrib_jamath', 'isha', 'isha_jamath',
        'sehri_end', 'zawal', 'jumah'
    ];

    public function masjid(): BelongsTo
    {
        return $this->belongsTo(Masjid::class);
    }
}
