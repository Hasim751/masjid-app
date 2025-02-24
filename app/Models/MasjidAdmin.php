<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MasjidAdmin extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'masjid_id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function masjid(): BelongsTo
    {
        return $this->belongsTo(Masjid::class);
    }
}
