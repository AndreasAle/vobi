<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

/**
 * Isi settings dengan konten live saat ini, supaya admin membuka Page Editor
 * dan langsung melihat teks yang sedang tampil (bukan field kosong).
 * Aman diulang: hanya mengisi key yang belum ada (tidak menimpa editan admin).
 */
class ContentSeeder extends Seeder
{
    public function run(): void
    {
        foreach ($this->defaults() as $key => $value) {
            Setting::firstOrCreate(
                ['key' => $key],
                ['value' => is_array($value) ? json_encode($value, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) : $value],
            );
        }
    }

    private function defaults(): array
    {
        return [
            // ===== Global =====
            'contact_wa_vobi' => '6289519406185',
            'contact_wa_seamedia' => '6282185606658',
            'contact_email' => 'seamediaindonesia@gmail.com',
            'contact_address' => 'Palembang, Sumatera Selatan',
            'social_instagram' => 'https://www.instagram.com/vobi.id/',
            'nav_cta_label' => 'Konsultasi →',
            'footer_tagline' => 'A Home Change Everything. Membangun bisnis & kreator bertumbuh bersama.',
            'footer_copyright' => 'V.O.B.I. Group — All rights reserved.',
            'footer_columns' => [
                ['title' => 'Ekosistem', 'links' => [
                    ['label' => 'VOBI MCN', 'url' => '/ekosistem'],
                    ['label' => 'TikTok Affiliate (TAP)', 'url' => '/layanan'],
                    ['label' => 'SEAMEDIA', 'url' => '/ekosistem'],
                    ['label' => 'Conversion Web', 'url' => '/creator'],
                ]],
                ['title' => 'Kolaborasi', 'links' => [
                    ['label' => 'Jadi Creator', 'url' => '/gabung'],
                    ['label' => 'Jadi Brand / Seller', 'url' => '/gabung'],
                    ['label' => 'Campaign Marketplace', 'url' => '/creator'],
                    ['label' => 'Layanan & Paket', 'url' => '/layanan'],
                ]],
            ],

            // ===== Home =====
            'home_hero_eyebrow' => 'Creator Economy / Digital Growth',
            'home_hero_l1' => 'A Home',
            'home_hero_l2' => 'Changes',
            'home_hero_l3' => 'Everything.',
            'home_hero_sub' => 'Every great journey begins with a place to belong. Kami menciptakan rumah — tempat yang nyaman untuk sebuah ide lahir, kolaborasi tumbuh, dan bisnis berkembang.',
            'home_service_cards' => [
                ['title' => 'Creator Management', 'tag' => 'VOBI MCN', 'color' => '#3B2E6E', 'image' => 'eco1'],
                ['title' => 'Campaign Marketplace', 'tag' => 'VOBI', 'color' => '#B05A32', 'image' => 'eco2'],
                ['title' => 'Viral & Story Driven Content', 'tag' => 'SEAMEDIA', 'color' => '#1F5D52', 'image' => 'vobi-content'],
                ['title' => 'Conversion Web & SEO', 'tag' => 'SEAMEDIA', 'color' => '#2B4E86', 'image' => 'vobi-web'],
                ['title' => 'Live Streaming Service', 'tag' => 'VOBI MCN', 'color' => '#7A3560', 'image' => 'succ3'],
            ],
            'home_brands_eyebrow' => 'Dipercaya Oleh',
            'home_brands_title' => 'Brand ternama yang tumbuh bersama kami.',
            'home_brands' => ['Rinso', 'Unilever', "L'Oréal Paris", 'Listerine', 'Neutrogena', 'Blackmores', 'Y.O.U', 'Baseus', 'Madame Gie', 'Aveeno', 'Anlene', 'Robot', 'Grandville', 'Mom Uung', 'Anmum', 'Mixio', 'Greney', 'Moell', 'TKIS', 'Revita'],
            'home_perf_eyebrow' => 'Performance Overview',
            'home_perf_title' => 'Angka yang bicara.',
            'home_perf_sub' => 'Rekap gabungan ekosistem VOBI Group — VOBI MCN & SEAMEDIA.',
            'home_eco_eyebrow' => 'Everything You Need · Under One Roof',
            'home_eco_title' => 'Empat pilar,<br>satu rumah.',
            'home_eco_sub' => 'Satu tujuan: membantu bisnis bertumbuh lebih cepat.',
            'home_eco_pillars' => [
                ['tag' => 'TikTok Affiliate · MCN', 'name' => 'VOBI', 'desc' => 'Rumah bagi 600+ talent — dibina dari micro sampai mega-scale, dan diberi panggung.', 'image' => 'eco1', 'url' => '/ekosistem'],
                ['tag' => 'TikTok · Top Creator', 'name' => 'VICTORY MEDIA', 'desc' => 'Ekspansi kreator top & kerjasama eksklusif.', 'image' => 'eco2', 'url' => '/ekosistem'],
                ['tag' => 'Shopee Affiliate', 'name' => 'UPMEDIA', 'desc' => 'Inkubasi & keberlangsungan affiliate Shopee.', 'image' => 'eco3', 'url' => '/ekosistem'],
                ['tag' => 'Content & Conversion Web', 'name' => 'SEAMEDIA', 'desc' => 'Produksi konten, live streaming, & website konversi untuk UMKM.', 'image' => 'vobi-content', 'url' => '/layanan'],
            ],
            'home_services_eyebrow' => 'What We Do',
            'home_services_title' => 'Layanan penuh, ujung ke ujung.',
            'home_services_sub' => 'Dari creator economy sampai produk digital — semua di bawah satu atap.',
            'home_services_rows' => [
                ['title' => 'Creator Economy', 'tags' => 'MCN · Affiliate · Campaign'],
                ['title' => 'Content Production', 'tags' => 'Photography · Videography · Livestream'],
                ['title' => 'Digital', 'tags' => 'Website · Landing Page · SEO · Maintenance'],
                ['title' => 'Social Media', 'tags' => 'Management · Strategy · Monthly Content · Ads'],
            ],
            'home_mkt_title' => 'Campaign *Marketplace*',
            'home_success_eyebrow' => 'Featured Success',
            'home_success_title' => 'Bukti, bukan janji.',
            'home_success_sub' => 'Geser untuk lihat transformasi kreator, brand, dan campaign kami. →',
            'home_testi_quote' => '"Karena dukungan Tim VOBI, aku bisa dapat sampai *600 juta* dalam satu sesi live. VOBI bener-bener rumah yang ngebimbing."',
            'home_testi_author' => '*Kesya* — Talent Fashion, VOBI MCN',
            'home_blog_eyebrow' => 'Latest Blog',
            'home_blog_title' => 'Ilmu dari lapangan.',
            'home_blog_sub' => 'Tips kreator, insight marketplace, dan tren digital terbaru.',
            'home_faq' => [
                ['q' => 'Gimana cara brand mulai kerjasama?', 'a' => 'Pilih kreator di Campaign Marketplace, klik "Ajak Kerjasama", isi form singkat — tim kami langsung menghubungi kamu.'],
                ['q' => 'Saya kreator baru, boleh gabung?', 'a' => 'Sangat boleh. VOBI MCN memang rumah untuk kreator dari nol — non-seleb, real affiliate, semua kami bimbing.'],
                ['q' => 'Platform apa saja yang didukung?', 'a' => 'TikTok, Shopee, Lazada, dan YouTube — lewat unit VOBI, Victory Media, dan Upmedia.'],
                ['q' => 'VOBI beroperasi di kota mana?', 'a' => 'Palembang, Jakarta, Bandung, Jogja, Bali, Lampung, dan Jambi — dan terus berkembang.'],
            ],
            'home_final_eyebrow' => 'Mari Mulai',
            'home_final_title' => 'Mari tumbuh<br>*bersama* kami.',
            'home_final_text' => 'Brand mencari kreator? Kreator mencari rumah? Pintunya di sini.',
        ];
    }
}
