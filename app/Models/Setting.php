<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    protected $fillable = ['key', 'value'];

    public $timestamps = true;

    protected static function booted(): void
    {
        static::saved(fn () => Cache::forget('settings.all'));
        static::deleted(fn () => Cache::forget('settings.all'));
    }

    /**
     * Semua setting sebagai map key => value (di-cache).
     */
    public static function map(): array
    {
        return Cache::rememberForever('settings.all', function () {
            try {
                return static::query()->pluck('value', 'key')->toArray();
            } catch (\Throwable $e) {
                return []; // tabel belum ada / DB belum siap
            }
        });
    }

    public static function get(string $key, $default = null)
    {
        return static::map()[$key] ?? $default;
    }

    public static function put(string $key, $value): void
    {
        static::updateOrCreate(['key' => $key], ['value' => $value]);
    }
}
