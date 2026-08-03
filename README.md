# VOBI Group — Website

Website resmi VOBI Group (VOBI MCN & SEAMEDIA) — talent agency & creator economy.
Dibangun dengan **Laravel 12** + Blade + Vite (CSS/JS custom). Data-driven (kreator, campaign, artikel).

## Fitur
- Home, Ekosistem, Layanan & Harga, **Creator** (katalog + popup detail + grafik), **Campaign** (listing + detail paket + masa berlaku), **Blog** (magazine + artikel), Kontak, Cara Gabung.
- Form lead (Cara Gabung, Kontak, Ajak Kerjasama, Ajukan Campaign) tersimpan ke tabel `leads` **dan dikirim ke email**. Email pengajuan Campaign menyertakan **PIC** penanggung jawab.
- SEO lengkap: meta, Open Graph, JSON-LD, sitemap.xml, robots.txt.

## Admin / CMS (Filament) — `/admin`
Login: `admin@vobi.id` / `vobi-admin-2024` (ganti password setelah deploy).
- **Konten**: CRUD Creator, Campaign (deliverables, masa berlaku ±1 bln, PIC), Artikel (RichEditor + cover).
- **Tampilan Situs**: editor teks & gambar untuk Global (kontak/footer/nav/SEO), Home, Ekosistem, Layanan — semua field punya fallback ke teks default (tak pecah bila kosong).
- **Leads / Pesan**: arsip semua submission form + ubah status.
- Email tujuan diatur di **Global → Email tujuan notifikasi** atau `MAIL_TO` di `.env`. SMTP diisi di `.env` (`MAIL_MAILER`, dst).

## Setup lokal
```bash
composer install
npm install
cp .env.example .env
php artisan key:generate
touch database/database.sqlite   # DB lokal pakai SQLite
php artisan migrate --seed
npm run build                    # atau: npm run dev
php artisan serve
```

## Deploy ke hosting (SSH)
```bash
git clone https://github.com/AndreasAle/vobi.git
cd vobi
composer install --no-dev --optimize-autoloader
cp .env.example .env             # isi APP_KEY, APP_URL, kredensial MySQL
php artisan key:generate
php artisan migrate --seed --force
php artisan storage:link
php artisan config:cache && php artisan route:cache && php artisan view:cache
```
Aset compiled (`public/build`) & aset Filament (`public/css|js/filament`) sudah ikut di repo — tidak wajib `npm build` di server.
Arahkan document root web ke folder **`public/`**. Pastikan `storage/` & `bootstrap/cache/` writable.
`storage:link` wajib supaya gambar upload dari admin tampil. Update konten berikutnya: cukup `git pull && php artisan migrate --force && php artisan config:cache`.

## Catatan
- `.env` TIDAK ikut di repo (rahasia). Set manual di server.
- Database lokal (`*.sqlite`) di-ignore. Produksi pakai MySQL.
- Kontak: VOBI MCN 0895-1940-6185 · SEAMEDIA 0821-8560-6658 · seamediaindonesia@gmail.com

---
&copy; VOBI Group — Palembang, Sumatera Selatan.
