<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $fillable = ['service_id', 'pick_up_place', 'drop_down_place', 'pick_up_time', 'drop_down_time'];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
