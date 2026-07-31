<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    protected $guarded = [];

    protected $casts = [
        'price'      => 'integer',
        'is_active'  => 'boolean',
        'details'    => 'array',
        'highlights' => 'array',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function getPriceShortAttribute(): string
    {
        return 'Rp ' . Creator::shortRupiah($this->price);
    }
}
