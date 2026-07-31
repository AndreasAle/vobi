# VOBI Group — Website

Website resmi VOBI Group (VOBI MCN & SEAMEDIA) — talent agency & creator economy.
Dibangun dengan **Laravel 12** + Blade + Vite (CSS/JS custom). Data-driven (kreator, campaign, artikel).

## Fitur
- Home, Ekosistem, Layanan & Harga, **Creator** (katalog + popup detail + grafik), **Campaign** (listing + detail paket), **Blog** (magazine + artikel), Kontak, Cara Gabung.
- Form lead (Cara Gabung, Kontak, Ajak Kerjasama) tersimpan ke tabel `leads`.
- SEO lengkap: meta, Open Graph, JSON-LD, sitemap.xml, robots.txt.

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
php artisan config:cache && php artisan route:cache && php artisan view:cache
```
Aset compiled (`public/build`) sudah ikut di repo — tidak wajib `npm build` di server.
Arahkan document root web ke folder **`public/`**. Pastikan `storage/` & `bootstrap/cache/` writable.

## Catatan
- `.env` TIDAK ikut di repo (rahasia). Set manual di server.
- Database lokal (`*.sqlite`) di-ignore. Produksi pakai MySQL.
- Kontak: VOBI MCN 0895-1940-6185 · SEAMEDIA 0821-8560-6658 · seamediaindonesia@gmail.com

---
&copy; VOBI Group — Palembang, Sumatera Selatan.
