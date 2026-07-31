<?php

namespace Database\Seeders;

use App\Models\Campaign;
use App\Models\Creator;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class MarketplaceSeeder extends Seeder
{
    public function run(): void
    {
        Creator::truncate();
        Campaign::truncate();

        // ===== Talent asli VOBI MCN (dari company profile) =====
        // [name, handle, category, platform, city, followers(est), eng, gmv_3m, price_from, avatar, featured, bio]
        $creators = [
            ['Kesya', '@kesyamartgorsir', 'Fashion', 'TikTok', 'Palembang', 480000, 6.2, 1_600_000_000, 15_000_000, 'succ1', true,
                'Talent fashion & underwear dengan performa tinggi — pernah meraih Rp 600 juta dalam satu sesi live bersama tim VOBI.'],
            ['Siswanto', '@siswanto146088', 'Food & Beverage', 'TikTok', 'Palembang', 210000, 7.0, 450_000_000, 6_000_000, 'blog1', true,
                'Live streaming 24 jam bergantian dengan pasangan. Peraih Award Festival Beli Lokal by Tokopedia, Agustus 2024.'],
            ['Jajankhasindo', '@jajankhasindo99', 'Food & Beverage', 'TikTok', 'Palembang', 168000, 6.5, 269_059_686, 4_500_000, 'blog3', true,
                'Kreator kuliner dengan pertumbuhan GMV konsisten hingga Rp 269 juta.'],
            ['Bakulankoe', '@bakulankoe88', 'Fashion', 'TikTok', 'Palembang', 96000, 5.4, 101_509_011, 3_000_000, 'succ4', false,
                'Menunjukkan pertumbuhan GMV yang baik, tembus Rp 101 juta.'],
            ['Racun TikTok', '@racuntiktok.office', 'Home Living', 'TikTok', 'Palembang', 132000, 5.8, 84_000_000, 3_500_000, 'eco4', false,
                'Kreator Home Living yang konsisten mendorong penjualan produk rumah tangga.'],
            ['Intan Saputri', '@intansaputri895', 'Fashion', 'TikTok', 'Palembang', 58000, 6.0, 52_000_000, 2_500_000, 'test', false,
                'Talent fashion dalam pembinaan VOBI, tumbuh dari micro menuju profesional.'],
        ];

        foreach ($creators as [$name, $handle, $cat, $plat, $city, $foll, $eng, $gmv, $price, $avatar, $featured, $bio]) {
            Creator::create([
                'name'            => $name,
                'slug'            => Str::slug($name),
                'handle'          => $handle,
                'category'        => $cat,
                'platform'        => $plat,
                'city'            => $city,
                'followers'       => $foll,
                'engagement_rate' => $eng,
                'gmv_3m'          => $gmv,
                'price_from'      => $price,
                'avatar'          => $avatar,
                'sow'             => 'Kerjasama affiliate (TAP) atau card rate — live streaming & video pendek. Komisi lebih tinggi dari komisi dasar; sampel produk gratis sesuai kategori.',
                'bio'             => $bio,
                'is_active'       => true,
                'is_featured'     => $featured,
            ]);
        }

        // ===== Paket/Campaign asli (VOBI MCN + SEAMEDIA) =====
        $campaigns = [
            [
                'title' => 'Viral Content Production', 'category' => 'Content Creation', 'service' => 'Content / Host & Live',
                'creator_name' => 'SEAMEDIA', 'price' => 2_000_000, 'performance' => 'Reach cepat', 'image' => 'vobi-content',
                'subtitle' => 'Reach, engagement & awareness cepat lewat format konten viral yang diadaptasi ke karakter brand kamu.',
                'note' => '*Paket tidak termasuk manajemen chat/DM.',
                'highlights' => ['Riset tren, hook & editing style', 'Diadaptasi ke identitas brand', 'Dua pilihan fokus: penjualan / impresi'],
                'details' => [
                    ['label' => 'Paket A — Host & Live (Fokus Penjualan)', 'items' => [
                        '20 jam live streaming/bulan (1,5 jam × 3 hari/minggu)', '5 video Reels/TikTok (teaser/shoppable)',
                        '10 design feeds (flyer promo / produk)', 'Konsep live & scripting singkat', 'Riset kata kunci (SEO) live',
                        'Jadwal live & poster pengumuman', 'Optimasi bio sosial media', 'Host live & operator dasar', 'Laporan insight bulanan',
                    ]],
                    ['label' => 'Paket B — Content Production (Fokus Impresi)', 'items' => [
                        '10 video Reels/TikTok (edit standar)', '10 feed foto (carousel/single)', 'Konsep konten & content plan',
                        'Riset SEO', 'Content calendar (jadwal posting)', 'Optimasi bio', 'Jasa upload & copywriting caption', 'Laporan insight bulanan',
                    ]],
                ],
            ],
            [
                'title' => 'Story Driven Production', 'category' => 'Branding', 'service' => 'Storytelling / Branding',
                'creator_name' => 'SEAMEDIA', 'price' => 3_000_000, 'performance' => 'Branding kuat', 'image' => 'vobi-event',
                'subtitle' => 'Bangun identitas, karakter & hubungan emosional dengan audiens — bukan sekadar bergantung pada promo atau tren.',
                'note' => '*Paket tidak termasuk manajemen chat/DM.',
                'highlights' => ['Signature content yang khas', 'Membangun loyalitas jangka panjang', 'Didampingi brand development consultant'],
                'details' => [
                    ['label' => 'Deliverables (Fokus Branding)', 'items' => [
                        '3 Signature Story Video', '7 Supporting Daily Video', '10 Feed Content', 'Riset SEO',
                        'Optimasi Bio Media Sosial', 'Jasa Upload & Copywriting Caption', 'Laporan Insight Bulanan',
                    ]],
                    ['label' => 'Strategi Brand', 'items' => [
                        'Brand Audit', 'Brand Direction', 'Signature Content', 'Story Telling Direction', 'Brand Development Consultant',
                    ]],
                ],
            ],
            [
                'title' => 'Live Streaming Support', 'category' => 'Live', 'service' => 'Studio + Host',
                'creator_name' => 'VOBI MCN', 'price' => 200_000, 'performance' => 'Live maksimal', 'image' => 'succ3',
                'subtitle' => 'Studio & host profesional untuk memaksimalkan waktu live streaming dan meningkatkan profit.',
                'note' => 'Harga mulai dari Rp 200.000. Disesuaikan dengan durasi & kebutuhan.',
                'highlights' => ['Studio siap pakai', 'Host & operator profesional', 'Untuk brand/seller maupun talent'],
                'details' => [
                    ['label' => 'Termasuk', 'items' => [
                        'Studio live streaming', 'Host profesional', 'Operator & dukungan teknis live',
                        'Maksimalkan waktu tayang live', 'Bantu tingkatkan profit',
                    ]],
                ],
            ],
            [
                'title' => 'Product Videography Footage', 'category' => 'Video', 'service' => 'Footage Produk',
                'creator_name' => 'VOBI MCN', 'price' => 150_000, 'performance' => 'Siap pasar', 'image' => 'vobi-beauty',
                'subtitle' => 'Footage produk berkualitas untuk brand/seller yang siap dipasarkan.',
                'note' => 'Harga mulai dari Rp 150.000. Disesuaikan dengan jumlah & jenis produk.',
                'highlights' => ['Kualitas siap pasar', 'Untuk brand & seller', 'Bagian dari ekosistem VOBI'],
                'details' => [
                    ['label' => 'Termasuk', 'items' => [
                        'Pembuatan footage produk', 'Kualitas videografi siap pasar', 'Sesuai kebutuhan pemasaran produk', 'Paket footage VOBI',
                    ]],
                ],
            ],
            [
                'title' => 'Conversion Web — Launch', 'category' => 'Website', 'service' => 'Website Baru',
                'creator_name' => 'SEAMEDIA', 'price' => 1_250_000, 'performance' => 'Siap tayang', 'image' => 'vobi-web',
                'subtitle' => 'Website profesional siap tayang untuk unit bisnis & UMKM — dari konten menuju konversi nyata.',
                'note' => 'Add-on: tambah halaman Rp 200rb · upload produk Rp 15rb/produk · edit konten Rp 150rb · maintenance Rp 350rb/bln.',
                'highlights' => ['Terpercaya & profesional', 'Mandiri, tak bergantung marketplace', 'Siap di-index Google'],
                'details' => [
                    ['label' => 'Website / Landing Page (7 halaman)', 'items' => [
                        'Home / Landing Page', 'Profil usaha / About', 'Produk / jasa / menu', 'Gallery', 'Testimoni', 'Lokasi / Google Maps', 'Kontak & sosial media',
                    ]],
                    ['label' => 'Fitur & SEO', 'items' => [
                        'Dashboard Admin Basic', 'SEO Basic (meta title & description)', 'Struktur halaman ramah Google', 'Favicon & sitemap basic',
                        'Setup siap di-index Google', 'WhatsApp funnel (tombol WA otomatis)',
                    ]],
                ],
            ],
            [
                'title' => 'Conversion Web — Care', 'category' => 'Website', 'service' => 'Maintenance',
                'creator_name' => 'SEAMEDIA', 'price' => 1_500_000, 'performance' => 'Terjaga', 'image' => 'vobi-web',
                'subtitle' => 'Jaga keberlangsungan website yang sudah ada — update rutin & dukungan teknis.',
                'note' => 'Dikhususkan untuk bisnis yang sudah memiliki website.',
                'highlights' => ['Website selalu update', 'Dukungan teknis berkelanjutan', 'Performa terjaga'],
                'details' => [
                    ['label' => 'Termasuk', 'items' => [
                        'Pemeliharaan berkala', 'Update konten & fitur', 'Dukungan teknis berkelanjutan', 'Optimasi performa website',
                    ]],
                ],
            ],
        ];

        foreach ($campaigns as $c) {
            Campaign::create([
                'title'        => $c['title'],
                'slug'         => Str::slug($c['title']),
                'subtitle'     => $c['subtitle'],
                'category'     => $c['category'],
                'service'      => $c['service'],
                'creator_name' => $c['creator_name'],
                'price'        => $c['price'],
                'sow'          => $c['subtitle'],
                'details'      => $c['details'],
                'note'         => $c['note'],
                'highlights'   => $c['highlights'],
                'performance'  => $c['performance'],
                'image'        => $c['image'],
                'is_active'    => true,
            ]);
        }
    }
}
