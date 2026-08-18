<?php

namespace App\Filament\Pages;

use App\Filament\Pages\Concerns\SettingsPage;
use Filament\Forms;
use Filament\Forms\Components\Section;

class ManageHome extends SettingsPage
{
    protected static ?string $navigationIcon = 'heroicon-o-home';
    protected static ?string $navigationGroup = 'Tampilan Situs';
    protected static ?string $navigationLabel = 'Halaman Home';
    protected static ?string $title = 'Edit Halaman Home';
    protected static ?int $navigationSort = 2;

    protected function keys(): array
    {
        return [
            'home_hero_eyebrow', 'home_hero_l1', 'home_hero_l2', 'home_hero_l3', 'home_hero_sub', 'home_service_cards',
            'home_brands_eyebrow', 'home_brands_title', 'home_brands',
            'home_perf_eyebrow', 'home_perf_title', 'home_perf_sub',
            'home_perf_s1_pre', 'home_perf_s1_val', 'home_perf_s1_suf', 'home_perf_s1_label',
            'home_perf_s2_val', 'home_perf_s2_suf', 'home_perf_s2_label',
            'home_perf_s3_val', 'home_perf_s3_suf', 'home_perf_s3_label',
            'home_perf_s4_val', 'home_perf_s4_suf', 'home_perf_s4_label',
            'home_perf_s5_val', 'home_perf_s5_suf', 'home_perf_s5_label', 'home_perf_s6_title', 'home_perf_s6_label',
            'home_eco_eyebrow', 'home_eco_title', 'home_eco_sub', 'home_eco_pillars',
            'home_services_eyebrow', 'home_services_title', 'home_services_sub', 'home_services_rows',
            'home_mkt_title', 'home_mkt_cards',
            'home_mkt_chip1_v', 'home_mkt_chip1_k', 'home_mkt_chip2_v', 'home_mkt_chip2_k', 'home_mkt_chip3_v', 'home_mkt_chip3_k',
            'home_success_eyebrow', 'home_success_title', 'home_success_sub', 'home_success_items',
            'home_testi_quote', 'home_testi_author',
            'home_blog_eyebrow', 'home_blog_title', 'home_blog_sub',
            'home_faq',
            'home_final_eyebrow', 'home_final_title', 'home_final_text',
        ];
    }

    protected function formSchema(): array
    {
        return [
            Section::make('Hero')->columns(2)->schema([
                Forms\Components\TextInput::make('home_hero_eyebrow')->label('Eyebrow')->columnSpanFull()
                    ->placeholder('Creator Economy / Digital Growth'),
                Forms\Components\TextInput::make('home_hero_l1')->label('Judul baris 1')->placeholder('A Home'),
                Forms\Components\TextInput::make('home_hero_l2')->label('Judul baris 2 (amber)')->placeholder('Changes'),
                Forms\Components\TextInput::make('home_hero_l3')->label('Judul baris 3')->placeholder('Everything.'),
                Forms\Components\Textarea::make('home_hero_sub')->label('Subjudul')->rows(3)->columnSpanFull(),
                Forms\Components\Repeater::make('home_service_cards')->label('Kartu Layanan (hero)')
                    ->schema([
                        Forms\Components\TextInput::make('title')->label('Judul')->required(),
                        Forms\Components\TextInput::make('tag')->label('Unit'),
                        Forms\Components\TextInput::make('link')->label('Link tujuan (saat diklik)')
                            ->placeholder('/creator, /layanan#content, dll'),
                        Forms\Components\ColorPicker::make('color')->label('Warna'),
                        Forms\Components\FileUpload::make('image')->label('Gambar')->image()->directory('home')->disk('public'),
                    ])
                    ->itemLabel(fn (array $state): ?string => $state['title'] ?? null)
                    ->collapsed()->cloneable()->grid(2)->columnSpanFull(),
            ]),

            Section::make('Brand Wall')->columns(2)->schema([
                Forms\Components\TextInput::make('home_brands_eyebrow')->label('Eyebrow')->placeholder('Dipercaya Oleh'),
                Forms\Components\TextInput::make('home_brands_title')->label('Judul')->placeholder('Brand ternama yang tumbuh bersama kami.'),
                Forms\Components\Repeater::make('home_brands')->label('Daftar brand')
                    ->schema([
                        Forms\Components\TextInput::make('name')->label('Nama brand')->required(),
                        Forms\Components\FileUpload::make('logo')->label('Logo (opsional)')->image()
                            ->directory('brands')->disk('public')
                            ->helperText('Kosong = tampil sebagai teks nama.'),
                    ])
                    ->itemLabel(fn (array $state): ?string => $state['name'] ?? null)
                    ->collapsed()->cloneable()->grid(2)->columnSpanFull()
                    ->addActionLabel('Tambah brand'),
            ]),

            Section::make('Performance')->columns(3)->schema([
                Forms\Components\TextInput::make('home_perf_eyebrow')->label('Eyebrow')->placeholder('Performance Overview'),
                Forms\Components\TextInput::make('home_perf_title')->label('Judul')->placeholder('Angka yang bicara.'),
                Forms\Components\TextInput::make('home_perf_sub')->label('Subjudul'),
                Forms\Components\Fieldset::make('Angka statistik')->columns(4)->schema([
                    Forms\Components\TextInput::make('home_perf_s1_pre')->label('1 — Awalan')->placeholder('Rp '),
                    Forms\Components\TextInput::make('home_perf_s1_val')->label('1 — Angka')->numeric()->helperText('mis. 600'),
                    Forms\Components\TextInput::make('home_perf_s1_suf')->label('1 — Akhiran')->placeholder('Jt / Milyar'),
                    Forms\Components\TextInput::make('home_perf_s1_label')->label('1 — Label'),
                    Forms\Components\TextInput::make('home_perf_s2_val')->label('2 — Angka')->numeric(),
                    Forms\Components\TextInput::make('home_perf_s2_suf')->label('2 — Akhiran')->placeholder('+'),
                    Forms\Components\TextInput::make('home_perf_s2_label')->label('2 — Label')->columnSpan(2),
                    Forms\Components\TextInput::make('home_perf_s3_val')->label('3 — Angka')->numeric(),
                    Forms\Components\TextInput::make('home_perf_s3_suf')->label('3 — Akhiran')->placeholder('+'),
                    Forms\Components\TextInput::make('home_perf_s3_label')->label('3 — Label')->columnSpan(2),
                    Forms\Components\TextInput::make('home_perf_s4_val')->label('4 — Angka')->numeric(),
                    Forms\Components\TextInput::make('home_perf_s4_suf')->label('4 — Akhiran')->placeholder('+'),
                    Forms\Components\TextInput::make('home_perf_s4_label')->label('4 — Label')->columnSpan(2),
                    Forms\Components\TextInput::make('home_perf_s5_val')->label('5 — Angka')->numeric(),
                    Forms\Components\TextInput::make('home_perf_s5_suf')->label('5 — Akhiran'),
                    Forms\Components\TextInput::make('home_perf_s5_label')->label('5 — Label')->columnSpan(2),
                    Forms\Components\TextInput::make('home_perf_s6_title')->label('6 — Teks')->helperText('mis. Official Partner'),
                    Forms\Components\TextInput::make('home_perf_s6_label')->label('6 — Label')->columnSpan(3),
                ]),
            ]),

            Section::make('Ekosistem (4 Pilar)')->columns(3)->schema([
                Forms\Components\TextInput::make('home_eco_eyebrow')->label('Eyebrow'),
                Forms\Components\TextInput::make('home_eco_title')->label('Judul')->helperText('Boleh pakai <br>'),
                Forms\Components\TextInput::make('home_eco_sub')->label('Subjudul'),
                Forms\Components\Repeater::make('home_eco_pillars')->label('Pilar')
                    ->schema([
                        Forms\Components\TextInput::make('tag')->label('Tag'),
                        Forms\Components\TextInput::make('name')->label('Nama unit')->required(),
                        Forms\Components\Textarea::make('desc')->label('Deskripsi')->rows(2),
                        Forms\Components\FileUpload::make('image')->label('Gambar')->image()->directory('home')->disk('public'),
                        Forms\Components\TextInput::make('url')->label('Link')->placeholder('/ekosistem'),
                    ])
                    ->itemLabel(fn (array $state): ?string => $state['name'] ?? null)
                    ->collapsed()->cloneable()->columnSpanFull(),
            ]),

            Section::make('Layanan (list)')->columns(3)->schema([
                Forms\Components\TextInput::make('home_services_eyebrow')->label('Eyebrow')->placeholder('What We Do'),
                Forms\Components\TextInput::make('home_services_title')->label('Judul'),
                Forms\Components\TextInput::make('home_services_sub')->label('Subjudul'),
                Forms\Components\Repeater::make('home_services_rows')->label('Baris layanan')
                    ->schema([
                        Forms\Components\TextInput::make('title')->label('Judul')->required(),
                        Forms\Components\TextInput::make('tags')->label('Tags')->placeholder('MCN · Affiliate · Campaign'),
                    ])
                    ->itemLabel(fn (array $state): ?string => $state['title'] ?? null)
                    ->collapsed()->columnSpanFull(),
            ]),

            Section::make('Marketplace, Success & Blog (heading)')->columns(2)->schema([
                Forms\Components\TextInput::make('home_mkt_title')->label('Judul Marketplace')->columnSpanFull()
                    ->helperText('Kata dalam *bintang* akan jadi amber, mis. Campaign *Marketplace*'),
                Forms\Components\Repeater::make('home_mkt_cards')->label('Kartu Marketplace (3 kartu)')
                    ->helperText('Urutan: kartu ke-1 = TENGAH (besar), ke-2 = kiri, ke-3 = kanan.')
                    ->schema([
                        Forms\Components\FileUpload::make('image')->label('Gambar')->image()->imageEditor()->directory('mkt')->disk('public'),
                        Forms\Components\TextInput::make('name')->label('Nama')->required(),
                        Forms\Components\TextInput::make('category')->label('Kategori')->placeholder('Fashion · TikTok'),
                        Forms\Components\TextInput::make('metric')->label('Angka utama')->placeholder('Rp 1,6M'),
                        Forms\Components\TextInput::make('metric_label')->label('Label angka')->placeholder('GMV / 3bln'),
                        Forms\Components\TextInput::make('badge')->label('Badge')->placeholder('MACRO / MID'),
                    ])
                    ->itemLabel(fn (array $state): ?string => $state['name'] ?? null)
                    ->collapsed()->grid(3)->maxItems(3)->columnSpanFull()->addActionLabel('Tambah kartu'),
                Forms\Components\Fieldset::make('Chip mengambang (3)')->columns(3)->schema([
                    Forms\Components\TextInput::make('home_mkt_chip1_v')->label('Chip 1 — Nilai')->placeholder('48K'),
                    Forms\Components\TextInput::make('home_mkt_chip2_v')->label('Chip 2 — Nilai')->placeholder('↑ 6,2%'),
                    Forms\Components\TextInput::make('home_mkt_chip3_v')->label('Chip 3 — Nilai')->placeholder('Macro'),
                    Forms\Components\TextInput::make('home_mkt_chip1_k')->label('Chip 1 — Label')->placeholder('Followers'),
                    Forms\Components\TextInput::make('home_mkt_chip2_k')->label('Chip 2 — Label')->placeholder('Eng. Rate'),
                    Forms\Components\TextInput::make('home_mkt_chip3_k')->label('Chip 3 — Label')->placeholder('Tier'),
                ]),
                Forms\Components\TextInput::make('home_success_eyebrow')->label('Success — Eyebrow'),
                Forms\Components\TextInput::make('home_success_title')->label('Success — Judul'),
                Forms\Components\TextInput::make('home_success_sub')->label('Success — Subjudul')->columnSpanFull(),
                Forms\Components\Repeater::make('home_success_items')->label('Success — Kartu')
                    ->schema([
                        Forms\Components\FileUpload::make('image')->label('Gambar')->image()->directory('success')->disk('public'),
                        Forms\Components\TextInput::make('category')->label('Kategori')->placeholder('Talent · Fashion'),
                        Forms\Components\TextInput::make('metric')->label('Pencapaian (besar)')->placeholder('Rp 600Jt / Award Tokopedia'),
                        Forms\Components\TextInput::make('context')->label('Keterangan')->placeholder('satu sesi live'),
                        Forms\Components\TextInput::make('handle')->label('Handle / Nama')->placeholder('@kesyamartgorsir'),
                    ])
                    ->itemLabel(fn (array $state): ?string => $state['metric'] ?? null)
                    ->collapsed()->cloneable()->grid(2)->columnSpanFull()->addActionLabel('Tambah success'),
                Forms\Components\TextInput::make('home_blog_eyebrow')->label('Blog — Eyebrow'),
                Forms\Components\TextInput::make('home_blog_title')->label('Blog — Judul'),
                Forms\Components\TextInput::make('home_blog_sub')->label('Blog — Subjudul')->columnSpanFull(),
            ]),

            Section::make('Testimonial')->schema([
                Forms\Components\Textarea::make('home_testi_quote')->label('Kutipan')->rows(3)
                    ->helperText('Kata dalam *bintang* jadi amber.'),
                Forms\Components\TextInput::make('home_testi_author')->label('Penulis / atribusi'),
            ]),

            Section::make('FAQ')->schema([
                Forms\Components\Repeater::make('home_faq')->label('Pertanyaan')
                    ->schema([
                        Forms\Components\TextInput::make('q')->label('Pertanyaan')->required(),
                        Forms\Components\Textarea::make('a')->label('Jawaban')->rows(2)->required(),
                    ])
                    ->itemLabel(fn (array $state): ?string => $state['q'] ?? null)
                    ->collapsed()->columnSpanFull(),
            ]),

            Section::make('Final CTA')->columns(3)->schema([
                Forms\Components\TextInput::make('home_final_eyebrow')->label('Eyebrow')->placeholder('Mari Mulai'),
                Forms\Components\TextInput::make('home_final_title')->label('Judul')->helperText('Boleh <br> & *amber*'),
                Forms\Components\TextInput::make('home_final_text')->label('Teks'),
            ]),
        ];
    }
}
