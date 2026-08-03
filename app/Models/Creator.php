<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Creator extends Model
{
    protected $guarded = [];

    protected $casts = [
        'followers'       => 'integer',
        'engagement_rate' => 'float',
        'gmv_3m'          => 'integer',
        'price_from'      => 'integer',
        'is_active'       => 'boolean',
        'is_featured'     => 'boolean',
    ];

    /**
     * Tier diklasifikasikan otomatis dari jumlah followers.
     */
    public function getTierAttribute(): string
    {
        $f = $this->followers;

        return match (true) {
            $f >= 1_000_000 => 'Mega',
            $f >= 250_000   => 'Macro',
            $f >= 50_000    => 'Mid',
            default         => 'Micro',
        };
    }

    public function getFollowersShortAttribute(): string
    {
        return static::shortNumber($this->followers);
    }

    public function getGmvShortAttribute(): string
    {
        return 'Rp ' . static::shortRupiah($this->gmv_3m);
    }

    public function getPriceShortAttribute(): string
    {
        return 'Rp ' . static::shortRupiah($this->price_from);
    }

    public function getAvatarUrlAttribute(): string
    {
        return media_url($this->avatar, 'avatar');
    }

    public static function shortNumber(int $n): string
    {
        if ($n >= 1_000_000) return rtrim(rtrim(number_format($n / 1_000_000, 1, ',', ''), '0'), ',') . 'M';
        if ($n >= 1_000)     return rtrim(rtrim(number_format($n / 1_000, 0, ',', ''), '0'), ',') . 'K';
        return (string) $n;
    }

    public static function shortRupiah(int $n): string
    {
        if ($n >= 1_000_000_000) return rtrim(rtrim(number_format($n / 1_000_000_000, 1, ',', ''), '0'), ',') . 'M';
        if ($n >= 1_000_000)     return rtrim(rtrim(number_format($n / 1_000_000, 1, ',', ''), '0'), ',') . 'Jt';
        if ($n >= 1_000)         return rtrim(rtrim(number_format($n / 1_000, 0, ',', ''), '0'), ',') . 'rb';
        return (string) $n;
    }
}
