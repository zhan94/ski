<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ServiceDataDate extends Model
{
    use HasFactory;
    public $incrementing = false;

    protected $fillable  = [
        'service_date', 'max'
    ];
}
