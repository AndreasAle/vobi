<?php

namespace App\Filament\Pages;

use App\Filament\Pages\Concerns\SettingsPage;
use Filament\Forms;
use Filament\Forms\Components\Section;

class ManageLayanan extends SettingsPage
{
    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';
    protected static ?string $navigationGroup = 'Tampilan Situs';
    protected static ?string $navigationLabel = 'Halaman Layanan';
    protected static ?string $title = 'Edit Halaman Layanan';
    protected static ?int $navigationSort = 4;

    protected function keys(): array
    {
        return [
            'lay_hero_eyebrow', 'lay_hero_title', 'lay_hero_lead',
            'lay_cat1_title', 'lay_cat1_desc', 'lay_cat2_title', 'lay_cat2_desc', 'lay_cat3_title', 'lay_cat3_desc',
            'lay_pricing_eyebrow', 'lay_pricing_title', 'lay_pricing_sub', 'lay_pricing',
            'lay_process_eyebrow', 'lay_process_title', 'lay_process_sub', 'lay_process',
            'lay_final_eyebrow', 'lay_final_title', 'lay_final_text',
        ];
    }

    protected function formSchema(): array
    {
        return [
            Section::make('Hero')->columns(2)->schema([
                Forms\Components\TextInput::make('lay_hero_eyebrow')->label('Eyebrow'),
                Forms\Components\TextInput::make('lay_hero_title')->label('Judul')->helperText('*kata* jadi amber'),
                Forms\Components\Textarea::make('lay_hero_lead')->label('Lead')->rows(2)->columnSpanFull(),
            ]),

            Section::make('Judul 3 Kategori')->columns(2)->schema([
                Forms\Components\TextInput::make('lay_cat1_title')->label('Kategori 1 — Judul'),
                Forms\Components\Textarea::make('lay_cat1_desc')->label('Kategori 1 — Deskripsi')->rows(2),
                Forms\Components\TextInput::make('lay_cat2_title')->label('Kategori 2 — Judul'),
                Forms\Components\Textarea::make('lay_cat2_desc')->label('Kategori 2 — Deskripsi')->rows(2),
                Forms\Components\TextInput::make('lay_cat3_title')->label('Kategori 3 — Judul'),
                Forms\Components\Textarea::make('lay_cat3_desc')->label('Kategori 3 — Deskripsi')->rows(2),
            ]),

            Section::make('Paket & Harga')->columns(3)->schema([
                Forms\Components\TextInput::make('lay_pricing_eyebrow')->label('Eyebrow'),
                Forms\Components\TextInput::make('lay_pricing_title')->label('Judul'),
                Forms\Components\TextInput::make('lay_pricing_sub')->label('Subjudul'),
                Forms\Components\Repeater::make('lay_pricing')->label('Kartu Paket')
                    ->schema([
                        Forms\Components\TextInput::make('unit')->label('Unit')->required(),
                        Forms\Components\TextInput::make('title')->label('Nama paket')->required(),
                        Forms\Components\TextInput::make('price')->label('Harga')->placeholder('Rp 2jt / mulai'),
                        Forms\Components\Toggle::make('hot')->label('Sorot (hot)')->inline(false),
                        Forms\Components\Textarea::make('desc')->label('Deskripsi (kalau tanpa bullet)')->rows(2),
                        Forms\Components\TagsInput::make('bullets')->label('Bullet (opsional)')->placeholder('Ketik + Enter'),
                        Forms\Components\TextInput::make('cta_label')->label('Teks tombol')->placeholder('Tanya Detail'),
                        Forms\Components\TextInput::make('cta_url')->label('Link tombol')->placeholder('/kontak'),
                    ])
                    ->itemLabel(fn (array $state): ?string => ($state['unit'] ?? '') . ' — ' . ($state['title'] ?? ''))
                    ->collapsed()->cloneable()->grid(2)->columnSpanFull(),
            ]),

            Section::make('Cara Kerja')->columns(3)->schema([
                Forms\Components\TextInput::make('lay_process_eyebrow')->label('Eyebrow'),
                Forms\Components\TextInput::make('lay_process_title')->label('Judul'),
                Forms\Components\TextInput::make('lay_process_sub')->label('Subjudul'),
                Forms\Components\Repeater::make('lay_process')->label('Langkah')
                    ->schema([
                        Forms\Components\TextInput::make('title')->label('Judul')->required(),
                        Forms\Components\TextInput::make('desc')->label('Deskripsi'),
                    ])
                    ->itemLabel(fn (array $state): ?string => $state['title'] ?? null)
                    ->collapsed()->columnSpanFull(),
            ]),

            Section::make('Final CTA')->columns(3)->schema([
                Forms\Components\TextInput::make('lay_final_eyebrow')->label('Eyebrow'),
                Forms\Components\TextInput::make('lay_final_title')->label('Judul')->helperText('*amber*'),
                Forms\Components\TextInput::make('lay_final_text')->label('Teks'),
            ]),
        ];
    }
}
