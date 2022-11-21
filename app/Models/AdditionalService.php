<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AdditionalService extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'pick_up_place', 'drop_down_place', 'from_date', 'to_date', 'description'];

    public function prices(): HasMany
    {
        return $this->hasMany(AdditionalServicePrice::class, 'service_id', 'id');
    }
}
