<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Service extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable  = [
        'name', 'max'
    ];

    public function data(): HasMany
    {
        return $this->hasMany(ServicesData::class);
    }

    public function locations(): HasMany
    {
        return $this->hasMany(Location::class);
    }
}
