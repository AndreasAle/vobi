<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Career extends Model
{
    protected $guarded = [];

    protected $casts = [
        'requirements' => 'array',
        'is_open'      => 'boolean',
        'posted_at'    => 'date',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function scopeOpen(Builder $q): Builder
    {
        return $q->where('is_open', true);
    }
}
