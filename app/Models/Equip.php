<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\belongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Service;

class Equip extends Model
{
    use HasFactory;

    protected $fillable = ['service_id', 'name'];

    public function service(): belongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function prices(): HasMany
    {
        return $this->hasMany(EquipPrice::class);
    }
}
