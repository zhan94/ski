<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KidServiceDate extends Model
{
    use HasFactory;

    protected $fillable  = [
        'kid_service_id', 'service_date'
    ];

    public function kid_service(): BelongsTo
    {
        return $this->belongsTo(KidService::class);
    }
}
