<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Card extends Model
{
    use HasFactory;

    public function service(): belongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function prices(): HasMany
    {
        return $this->hasMany(CardPrice::class);
    }
}
