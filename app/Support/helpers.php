<?php

use App\Mail\LeadReceived;
use App\Models\Campaign;
use App\Models\Lead;
use App\Models\Setting;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

if (! function_exists('setting')) {
    /**
     * Ambil setting teks. Kembalikan $default (teks hardcoded sekarang) bila kosong,
     * sehingga tampilan tidak pecah walau belum di-seed / diisi admin.
     */
    function setting(string $key, $default = null)
    {
        $v = Setting::get($key);

        return ($v === null || $v === '') ? $default : $v;
    }
}

if (! function_exists('setting_arr')) {
    /**
     * Ambil setting berupa list (JSON). Kembalikan $default bila kosong/invalid.
     */
    function setting_arr(string $key, array $default = []): array
    {
        $v = Setting::get($key);
        if (blank($v)) return $default;
        if (is_array($v)) return $v;

        $decoded = json_decode($v, true);

        return is_array($decoded) ? $decoded : $default;
    }
}

if (! function_exists('setting_img')) {
    /**
     * URL gambar dari setting (path upload) dengan fallback role/URL.
     */
    function setting_img(string $key, ?string $fallback = null): string
    {
        $v = Setting::get($key);

        return blank($v) ? ($fallback ? media_url($fallback) : '') : media_url($v);
    }
}

if (! function_exists('lead_recipient')) {
    /**
     * Email tujuan notifikasi lead. Prioritas: setting('mail_to') (Fase C) ->
     * env MAIL_TO -> alamat pengirim default.
     */
    function lead_recipient(): ?string
    {
        if (function_exists('setting')) {
            $s = setting('mail_to');
            if (filled($s)) return $s;
        }

        return env('MAIL_TO') ?: config('mail.from.address');
    }
}

if (! function_exists('notify_lead')) {
    /**
     * Kirim notifikasi lead ke email admin. Aman: gagal kirim tidak
     * menggagalkan submit form (lead sudah tersimpan di DB).
     */
    function notify_lead(Lead $lead, ?Campaign $campaign = null): void
    {
        $to = lead_recipient();
        if (blank($to)) return;

        try {
            Mail::to($to)->send(new LeadReceived($lead, $campaign));
        } catch (\Throwable $e) {
            Log::warning('Gagal kirim email lead: ' . $e->getMessage(), ['lead_id' => $lead->id]);
        }
    }
}

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
