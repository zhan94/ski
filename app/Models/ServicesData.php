<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ServicesData extends Model
{
    use HasFactory;

    protected $fillable  = [
        'service_id', 'max'
    ];

    public function kids(): HasMany
    {
        $select = ['id', 'services_data_id', 'kid_id', 'location_id'];
        return $this->hasMany(KidService::class)->select($select);
    }

    public function kids_count(): hasMany
    {
        return $this->hasMany(KidService::class)
            ->selectRaw('services_data_id, count(*) as count_total')
            ->groupBy('services_data_id');
    }

    public function service(): hasOne
    {
        return $this->hasOne(Service::class, 'id', 'service_id')->select(['id', 'name as service_name']);
    }

    public function dates(): hasMany
    {
        return $this->hasMany(ServiceDataDate::class, 'service_data_id', 'id');
    }

}
