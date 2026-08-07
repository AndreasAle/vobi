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
            'home_perf_s1_val', 'home_perf_s1_label', 'home_perf_s2_val', 'home_perf_s2_label',
            'home_perf_s3_val', 'home_perf_s3_label', 'home_perf_s4_val', 'home_perf_s4_label',
            'home_perf_s5_val', 'home_perf_s5_label', 'home_perf_s6_title', 'home_perf_s6_label',
            'home_eco_eyebrow', 'home_eco_title', 'home_eco_sub', 'home_eco_pillars',
            'home_services_eyebrow', 'home_services_title', 'home_services_sub', 'home_services_rows',
            'home_mkt_title',
            'home_success_eyebrow', 'home_success_title', 'home_success_sub',
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
                Forms\Components\TagsInput::make('home_brands')->label('Daftar brand')->placeholder('Ketik nama brand + Enter')->columnSpanFull(),
            ]),

            Section::make('Performance')->columns(3)->schema([
                Forms\Components\TextInput::make('home_perf_eyebrow')->label('Eyebrow')->placeholder('Performance Overview'),
                Forms\Components\TextInput::make('home_perf_title')->label('Judul')->placeholder('Angka yang bicara.'),
                Forms\Components\TextInput::make('home_perf_sub')->label('Subjudul'),
                Forms\Components\Fieldset::make('Angka statistik')->columns(4)->schema([
                    Forms\Components\TextInput::make('home_perf_s1_val')->label('1 — Angka')->numeric()->helperText('mis. 600'),
                    Forms\Components\TextInput::make('home_perf_s1_label')->label('1 — Label')->columnSpan(3),
                    Forms\Components\TextInput::make('home_perf_s2_val')->label('2 — Angka')->numeric(),
                    Forms\Components\TextInput::make('home_perf_s2_label')->label('2 — Label')->columnSpan(3),
                    Forms\Components\TextInput::make('home_perf_s3_val')->label('3 — Angka')->numeric(),
                    Forms\Components\TextInput::make('home_perf_s3_label')->label('3 — Label')->columnSpan(3),
                    Forms\Components\TextInput::make('home_perf_s4_val')->label('4 — Angka')->numeric(),
                    Forms\Components\TextInput::make('home_perf_s4_label')->label('4 — Label')->columnSpan(3),
                    Forms\Components\TextInput::make('home_perf_s5_val')->label('5 — Angka')->numeric(),
                    Forms\Components\TextInput::make('home_perf_s5_label')->label('5 — Label')->columnSpan(3),
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
                Forms\Components\TextInput::make('home_success_eyebrow')->label('Success — Eyebrow'),
                Forms\Components\TextInput::make('home_success_title')->label('Success — Judul'),
                Forms\Components\TextInput::make('home_success_sub')->label('Success — Subjudul')->columnSpanFull(),
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
