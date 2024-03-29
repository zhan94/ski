<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EquipPrice extends Model
{
    use HasFactory;

    protected $fillable = ['equip_id', 'days', 'price'];
}
