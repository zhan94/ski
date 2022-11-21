<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\hasOne;

class KidService extends Model
{
    use HasFactory;

    public function kidName(): hasOne
    {
        return $this->hasOne(Kid::class, 'id', 'kid_id')->select(['id', 'firstname', 'lastname', 'birth_date']);
    }

    public function kid(): hasOne
    {
        return $this->hasOne(Kid::class, 'id', 'kid_id');
    }

    public function location(): hasOne
    {
        return $this->hasOne(Location::class, 'id', 'location_id');
    }

    public function skill(): hasOne
    {
        return $this->hasOne(Skill::class, 'id', 'skill_id');
    }

    public function equip(): hasOne
    {
        return $this->hasOne(Equip::class, 'id', 'equip_id');
    }

    public function card(): hasOne
    {
        return $this->hasOne(Card::class, 'id', 'card_id');
    }

    public function service_data(): hasOne
    {
        return $this->hasOne(ServicesData::class, 'id', 'services_data_id');
    }
}
