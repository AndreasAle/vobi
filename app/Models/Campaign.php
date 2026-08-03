<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    protected $guarded = [];

    protected $casts = [
        'price'      => 'integer',
        'is_active'  => 'boolean',
        'details'    => 'array',
        'highlights' => 'array',
        'starts_at'  => 'date',
        'ends_at'    => 'date',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * Campaign yang benar-benar tayang: aktif, sudah mulai, belum berakhir.
     */
    public function scopeActive(Builder $q): Builder
    {
        $today = now()->startOfDay();

        return $q->where('is_active', true)
            ->where(fn ($w) => $w->whereNull('starts_at')->orWhere('starts_at', '<=', $today))
            ->where(fn ($w) => $w->whereNull('ends_at')->orWhere('ends_at', '>=', $today));
    }

    public function getStatusAttribute(): string
    {
        if (! $this->is_active) return 'Nonaktif';
        $today = now()->startOfDay();
        if ($this->starts_at && $this->starts_at->gt($today)) return 'Terjadwal';
        if ($this->ends_at && $this->ends_at->lt($today)) return 'Berakhir';

        return 'Aktif';
    }

    public function getIsLiveAttribute(): bool
    {
        return $this->status === 'Aktif';
    }

    /** Sisa hari sampai berakhir (null jika tak ada ends_at). */
    public function getDaysLeftAttribute(): ?int
    {
        if (! $this->ends_at) return null;

        return (int) now()->startOfDay()->diffInDays($this->ends_at, false);
    }

    public function getPriceShortAttribute(): string
    {
        return 'Rp ' . Creator::shortRupiah($this->price);
    }

    public function getImageUrlAttribute(): string
    {
        return media_url($this->image, 'eco1');
    }
}
