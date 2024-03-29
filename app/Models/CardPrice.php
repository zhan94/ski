<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CardPrice extends Model
{
    use HasFactory;

    protected $fillable = ['card_id', 'days', 'price'];
}
