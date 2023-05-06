<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceDataDate extends Model
{
    use HasFactory;

    protected $fillable  = [
        'service_data_id', 'service_data_date'
    ];
}
