<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kid extends Model
{
    use HasFactory;

    protected $fillable = [
        'firstname', 'surname', 'lastname', 'birth_date', 'active', 'note', 'parent_name', 'parent_phone_number', 'parent_email'
    ];

    public function kid_services(): HasMany
    {
        return $this->hasMany(KidService::class);
    }
}
