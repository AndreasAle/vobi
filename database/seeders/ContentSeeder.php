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

        $this->patchServiceCardLinks();
        $this->patchBrandsToObjects();

        // Patch: ganti heading harga lama (client minta tanpa nominal)
        $this->patchValue('lay_pricing_eyebrow', 'Paket & Investasi', 'Paket Layanan');
        $this->patchValue('lay_pricing_title', 'Harga transparan.', 'Pilih paket yang pas.');
        $this->patchValue('lay_pricing_sub', 'Semua paket bisa dikustomisasi sesuai skala kebutuhanmu.', 'Semua paket bisa dikustomisasi sesuai skala kebutuhanmu — hubungi kami untuk detail.');
    }

    /** Ubah home_brands dari daftar string (format lama) menjadi [{name, logo}]. */
    private function patchBrandsToObjects(): void
    {
        $s = Setting::where('key', 'home_brands')->first();
        if (! $s) return;

        $items = json_decode($s->value, true);
        if (! is_array($items) || $items === []) return;

        // Sudah format objek? lewati.
        if (is_array($items[0] ?? null)) return;

        $converted = array_map(fn ($name) => ['name' => (string) $name, 'logo' => null], $items);
        $s->value = json_encode($converted, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        $s->save();
    }

    /** Ganti nilai setting HANYA jika masih sama dengan nilai lama (non-destruktif). */
    private function patchValue(string $key, string $old, string $new): void
    {
        $s = Setting::where('key', $key)->first();
        if ($s && $s->value === $old) {
            $s->value = $new;
            $s->save();
        }
    }

    /**
     * Tambahkan 'link' ke kartu layanan yang belum punya (fitur baru, non-destruktif).
     */
    private function patchServiceCardLinks(): void
    {
        $setting = Setting::where('key', 'home_service_cards')->first();
        if (! $setting) return;

        $cards = json_decode($setting->value, true);
        if (! is_array($cards)) return;

        $map = [
            'Creator Management' => '/creator',
            'Campaign Marketplace' => '/campaign',
            'Viral & Story Driven Content' => '/layanan#content',
            'Conversion Web & SEO' => '/layanan#web',
            'Live Streaming Service' => '/layanan#mcn',
        ];

        $changed = false;
        foreach ($cards as &$card) {
            if (empty($card['link'])) {
                $card['link'] = $map[$card['title'] ?? ''] ?? '/layanan';
                $changed = true;
            }
        }
        unset($card);

        if ($changed) {
            $setting->value = json_encode($cards, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
            $setting->save();
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
                ['title' => 'Creator Management', 'tag' => 'VOBI MCN', 'color' => '#3B2E6E', 'image' => 'eco1', 'link' => '/creator'],
                ['title' => 'Campaign Marketplace', 'tag' => 'VOBI', 'color' => '#B05A32', 'image' => 'eco2', 'link' => '/campaign'],
                ['title' => 'Viral & Story Driven Content', 'tag' => 'SEAMEDIA', 'color' => '#1F5D52', 'image' => 'vobi-content', 'link' => '/layanan#content'],
                ['title' => 'Conversion Web & SEO', 'tag' => 'SEAMEDIA', 'color' => '#2B4E86', 'image' => 'vobi-web', 'link' => '/layanan#web'],
                ['title' => 'Live Streaming Service', 'tag' => 'VOBI MCN', 'color' => '#7A3560', 'image' => 'succ3', 'link' => '/layanan#mcn'],
            ],
            'home_brands_eyebrow' => 'Dipercaya Oleh',
            'home_brands_title' => 'Brand ternama yang tumbuh bersama kami.',
            'home_brands' => ['Rinso', 'Unilever', "L'Oréal Paris", 'Listerine', 'Neutrogena', 'Blackmores', 'Y.O.U', 'Baseus', 'Madame Gie', 'Aveeno', 'Anlene', 'Robot', 'Grandville', 'Mom Uung', 'Anmum', 'Mixio', 'Greney', 'Moell', 'TKIS', 'Revita'],
            'home_perf_eyebrow' => 'Performance Overview',
            'home_perf_title' => 'Angka yang bicara.',
            'home_perf_sub' => 'Rekap gabungan ekosistem VOBI Group — VOBI MCN & SEAMEDIA.',
            'home_perf_s1_pre' => 'Rp ', 'home_perf_s1_val' => '600', 'home_perf_s1_suf' => 'Jt', 'home_perf_s1_label' => 'GMV per Sesi Live (talent terbaik)',
            'home_perf_s2_val' => '4600', 'home_perf_s2_suf' => '+', 'home_perf_s2_label' => 'Talent & Creator',
            'home_perf_s3_val' => '800', 'home_perf_s3_suf' => '+', 'home_perf_s3_label' => 'Brand & Seller Partner',
            'home_perf_s4_val' => '2000', 'home_perf_s4_suf' => '+', 'home_perf_s4_label' => 'Product Collaboration',
            'home_perf_s5_val' => '6', 'home_perf_s5_suf' => '', 'home_perf_s5_label' => 'Kategori Produk · Beauty, Fashion, F&B, Home Living, Mom & Baby, Electronic',
            'home_perf_s6_title' => 'Official Partner', 'home_perf_s6_label' => 'TikTok · Shopee · Tokopedia',
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
            'home_mkt_cards' => [
                ['name' => 'Kesya', 'category' => 'Fashion · TikTok', 'metric' => 'Rp 1,6M', 'metric_label' => 'GMV / 3bln', 'badge' => 'MACRO', 'image' => 'test'],
                ['name' => 'Siswanto', 'category' => 'Food & Beverage', 'metric' => 'Rp 450Jt', 'metric_label' => 'GMV / 3bln', 'badge' => 'MID', 'image' => 'blog1'],
                ['name' => 'Jajankhasindo', 'category' => 'Food & Beverage', 'metric' => 'Rp 269Jt', 'metric_label' => 'GMV / 3bln', 'badge' => 'MID', 'image' => 'blog3'],
            ],
            'home_mkt_chip1_v' => '48K', 'home_mkt_chip1_k' => 'Followers',
            'home_mkt_chip2_v' => '↑ 6,2%', 'home_mkt_chip2_k' => 'Eng. Rate',
            'home_mkt_chip3_v' => 'Macro', 'home_mkt_chip3_k' => 'Tier',
            'home_success_eyebrow' => 'Featured Success',
            'home_success_title' => 'Bukti, bukan janji.',
            'home_success_sub' => 'Geser untuk lihat transformasi kreator, brand, dan campaign kami. →',
            'home_success_items' => [
                ['image' => 'succ1', 'category' => 'Talent · Fashion', 'metric' => 'Rp 600Jt', 'context' => 'satu sesi live', 'handle' => '@kesyamartgorsir'],
                ['image' => 'blog1', 'category' => 'Talent · F&B', 'metric' => 'Award Tokopedia', 'context' => "Festival Beli Lokal '24", 'handle' => '@siswanto146088'],
                ['image' => 'blog3', 'category' => 'Talent · F&B', 'metric' => 'Rp 269Jt', 'context' => 'GMV tercapai', 'handle' => '@jajankhasindo99'],
                ['image' => 'succ4', 'category' => 'Talent · Fashion', 'metric' => 'Rp 101Jt', 'context' => 'GMV tumbuh konsisten', 'handle' => '@bakulankoe88'],
            ],
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

            // ===== Ekosistem =====
            'eko_welcome' => 'A Home Change Everything',
            'eko_title' => 'VOBI adalah<br>*rumah.*',
            'eko_sub' => 'Di rumah, kami menemukan kejujuran, kepercayaan, kebersamaan, dan niat untuk saling membangun. Scroll pelan — ikuti perjalanannya.',
            'eko_stops' => [
                ['city' => 'Filosofi', 'lh' => 'Makna *HOME*.', 'ld' => 'Tempat kita berangkat dan kembali — tempat diterima, didengar, dan tumbuh bersama.'],
                ['city' => 'VOBI MCN', 'lh' => 'Rumah *talent*.', 'ld' => '600+ talent dibina dari micro sampai mega-scale — jadi kreator yang profesional & menghibur.'],
                ['city' => 'TAP System', 'lh' => 'Menjodohkan *seller* & kreator.', 'ld' => 'TikTok Affiliate Partner: matchmaking + product campaign, 6 kategori. Komisi di atas rata-rata.'],
                ['city' => 'VOBI Family', 'lh' => 'Rasa *memiliki*.', 'ld' => 'Sense of belonging & komunikasi jadi fondasi partnership yang sukses — ekosistem yang nyaman.'],
                ['city' => 'SEAMEDIA', 'lh' => 'Dari konten ke *konversi*.', 'ld' => 'Professional partner untuk digital journey: produksi konten, live, sampai website konversi untuk UMKM.'],
            ],
            'eko_finale_kicker' => 'Berbasis di Palembang · Official Partner',
            'eko_finale_line' => '…dan terus *bertumbuh.*',
            'eko_finale_stats' => [
                ['value' => '600', 'suffix' => '+', 'label' => 'Talent'],
                ['value' => '4.000', 'suffix' => '+', 'label' => 'Creator'],
                ['value' => '800', 'suffix' => '+', 'label' => 'Brand/Seller'],
                ['value' => '2.000', 'suffix' => '+', 'label' => 'Collaboration'],
            ],
            'eko_units' => [
                ['uf' => 'Talent & MCN', 'un' => 'VOBI MCN', 'url' => '/gabung'],
                ['uf' => 'TikTok Affiliate', 'un' => 'TAP System', 'url' => '/layanan'],
                ['uf' => 'Content Creation', 'un' => 'SEAMEDIA', 'url' => '/layanan'],
                ['uf' => 'Website', 'un' => 'Conversion Web', 'url' => '/creator'],
            ],
            'eko_values' => ['Honesty', 'Trust', 'Togetherness', 'Growth', 'Convenience'],
            'eko_listening_quote' => '“Kami *mendengar* lebih dulu — menangkap input yang relevan, merespons pasar lebih efisien, dan membangun koneksi baik dengan kreator & klien.”',
            'eko_final_eyebrow' => 'Mari Mulai',
            'eko_final_title' => 'Mau jadi bagian<br>*keluarganya?*',
            'eko_final_text' => 'Talent mencari rumah? Brand mencari kreator? Pintunya di sini.',

            // ===== Layanan =====
            'lay_hero_eyebrow' => 'Layanan & Harga',
            'lay_hero_title' => 'Dua unit, *satu ekosistem*.',
            'lay_hero_lead' => 'VOBI MCN untuk talent, affiliate & live streaming TikTok. SEAMEDIA untuk produksi konten & website konversi. Semua dengan harga transparan.',
            'lay_cat1_title' => 'VOBI MCN',
            'lay_cat1_desc' => 'Rumah bagi 600+ talent — dibina dari micro sampai mega-scale, lengkap dengan sistem affiliate & dukungan live.',
            'lay_cat2_title' => 'SEAMEDIA · Content Creation',
            'lay_cat2_desc' => 'Konten promosi konsisten untuk awareness & penjualan — lewat strategi kreatif yang relevan dengan audiens.',
            'lay_cat3_title' => 'Conversion Web',
            'lay_cat3_desc' => 'Dari konten menuju konversi nyata — website profesional, katalog, & landing page untuk UMKM & unit usaha.',
            'lay_pricing_eyebrow' => 'Paket Layanan',
            'lay_pricing_title' => 'Pilih paket yang pas.',
            'lay_pricing_sub' => 'Semua paket bisa dikustomisasi sesuai skala kebutuhanmu — hubungi kami untuk detail.',
            'lay_pricing' => [
                ['unit' => 'VOBI MCN', 'title' => 'Live Streaming Support', 'price' => 'Rp 200rb / mulai', 'desc' => 'Studio + host profesional untuk memaksimalkan sesi live.', 'bullets' => [], 'hot' => false, 'cta_label' => 'Tanya Detail', 'cta_url' => '/kontak'],
                ['unit' => 'VOBI MCN', 'title' => 'Product Footage', 'price' => 'Rp 150rb / mulai', 'desc' => 'Footage videografi produk berkualitas, siap dipasarkan.', 'bullets' => [], 'hot' => false, 'cta_label' => 'Tanya Detail', 'cta_url' => '/kontak'],
                ['unit' => 'SEAMEDIA · Content', 'title' => 'Viral Content Production', 'price' => 'Rp 2jt / mulai', 'desc' => '', 'bullets' => ['Host & Live 20 jam/bln, atau', '10 Reels/TikTok + 10 feed foto', 'Content plan + riset SEO', 'Laporan insight bulanan'], 'hot' => true, 'cta_label' => 'Lihat Paket →', 'cta_url' => '/creator'],
                ['unit' => 'SEAMEDIA · Content', 'title' => 'Story Driven Production', 'price' => 'Rp 3jt / mulai', 'desc' => '', 'bullets' => ['3 signature story + 7 daily video', '10 feed content', 'Brand audit & direction', 'Konsultan brand development'], 'hot' => false, 'cta_label' => 'Tanya Detail', 'cta_url' => '/kontak'],
                ['unit' => 'Conversion Web', 'title' => 'Launch Package', 'price' => 'Rp 1,25jt', 'desc' => '', 'bullets' => ['Website/landing 7 halaman', 'Dashboard admin basic', 'SEO basic + siap di-index', 'WhatsApp funnel'], 'hot' => true, 'cta_label' => 'Pesan Website →', 'cta_url' => '/kontak'],
                ['unit' => 'Conversion Web', 'title' => 'Care Package', 'price' => 'Rp 1,5jt', 'desc' => 'Untuk yang sudah punya website — jaga keberlangsungan, update & dukungan teknis.', 'bullets' => [], 'hot' => false, 'cta_label' => 'Tanya Detail', 'cta_url' => '/kontak'],
                ['unit' => 'Conversion Web', 'title' => 'WA Funnel', 'price' => 'Rp 750rb', 'desc' => 'Landing page + tombol WhatsApp otomatis dengan format chat.', 'bullets' => [], 'hot' => false, 'cta_label' => 'Tanya Detail', 'cta_url' => '/kontak'],
                ['unit' => 'Conversion Web', 'title' => 'Signature Package', 'price' => 'Custom', 'desc' => 'Desain website premium & eksklusif dengan ciri khas unit bisnis.', 'bullets' => [], 'hot' => false, 'cta_label' => 'Konsultasi', 'cta_url' => '/kontak'],
            ],
            'lay_process_eyebrow' => 'Cara Kerja',
            'lay_process_title' => 'Lima langkah, tanpa ribet.',
            'lay_process_sub' => 'Alur transparan dari obrolan pertama sampai campaign menang.',
            'lay_process' => [
                ['title' => 'Discovery', 'desc' => 'Pahami tujuan, audiens, & skala kebutuhanmu.'],
                ['title' => 'Strategy', 'desc' => 'Petakan talent, platform, & paket yang pas.'],
                ['title' => 'Production', 'desc' => 'Eksekusi konten & live oleh tim berpengalaman.'],
                ['title' => 'Launch', 'desc' => 'Tayang, dipantau, dioptimasi real-time.'],
                ['title' => 'Report', 'desc' => 'Laporan insight & performa tiap bulan.'],
            ],
            'lay_final_eyebrow' => 'Butuh Bantuan?',
            'lay_final_title' => 'Konsultasi *gratis* dulu.',
            'lay_final_text' => 'Ceritakan kebutuhanmu — tim kami bantu petakan paket yang paling pas.',

            // ===== Kontak / Gabung / Blog =====
            'kontak_eyebrow' => 'Contact Us',
            'kontak_heading' => 'Mari tumbuh<br>*bersama* kami.',
            'kontak_lead' => 'Brand mencari kreator? Kreator mencari rumah? Ceritakan ke kami — konsultasi gratis.',
            'kontak_address' => "Perumahan Bakung Palace, Blk B No. 10,\nKec. Sako, Kota Palembang, Sumatera Selatan",
            'kontak_hours' => 'Senin–Sabtu, 09.00–18.00 WIB',
            'gabung_eyebrow' => 'Kolaborasi',
            'gabung_heading' => 'Dari kenalan<br>sampai cuan.',
            'gabung_lead' => 'Baik kamu kreator yang cari rumah, atau brand yang cari kreator — pintunya di sini.',
            'gabung_creator_note' => 'Isi data kamu dan ceritakan sedikit tentang konten yang kamu buat. Tim VOBI akan menghubungi untuk proses seleksi & onboarding — *non-seleb dan pemula sangat kami terima.*',
            'gabung_brand_note' => 'Ceritakan brand dan tujuan campaign kamu. Tim kami akan bantu carikan kreator yang paling pas, lengkap dengan estimasi harga & SOW.',
            'blog_eyebrow' => 'Latest Blog',
            'blog_heading' => 'Ilmu dari lapangan.',
            'career_eyebrow' => 'Bergabung',
            'career_heading' => 'Tumbuh *bareng* kami.',
            'career_lead' => 'Kami rumah untuk orang yang mau berkembang. Temukan posisi yang cocok, dan mari bangun sesuatu yang berarti.',
        ];
    }
}
