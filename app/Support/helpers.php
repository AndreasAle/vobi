<?php

use Illuminate\Support\Facades\Storage;

if (! function_exists('media_url')) {
    /**
     * Resolusi URL gambar yang backward-compatible:
     * - kosong        -> pakai fallback role (images/{fallback}.webp) atau ''
     * - "role" polos  -> asset('images/{role}.webp')   (data lama / seed)
     * - path upload   -> Storage public disk URL        (upload admin)
     */
    function media_url(?string $value, ?string $fallback = null): string
    {
        if (blank($value)) {
            return $fallback ? asset("images/{$fallback}.webp") : '';
        }

        // Legacy image role: tanpa slash & tanpa ekstensi -> images/{role}.webp
        if (! str_contains($value, '/') && ! str_contains($value, '.')) {
            return asset("images/{$value}.webp");
        }

        // File hasil upload admin (disimpan di public disk)
        return Storage::disk('public')->url($value);
    }
}
