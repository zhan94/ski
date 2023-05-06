<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KidServiceDate extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable  = [
        'kid_service_id', 'kid_service_date'
    ];
}
