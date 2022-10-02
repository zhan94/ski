<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EquipPrice extends Model
{
    protected $fillable = ['equip_id', 'day', 'price'];
    use HasFactory;
}
