<?php

namespace App\Filament\Pages;

use App\Filament\Pages\Concerns\SettingsPage;
use Filament\Forms;
use Filament\Forms\Components\Section;

class ManageGlobal extends SettingsPage
{
    protected static ?string $navigationIcon = 'heroicon-o-globe-alt';
    protected static ?string $navigationGroup = 'Tampilan Situs';
    protected static ?string $navigationLabel = 'Global (Kontak, Footer, SEO)';
    protected static ?string $title = 'Pengaturan Global';
    protected static ?int $navigationSort = 1;

    protected function keys(): array
    {
        return [
            'brand_logo', 'favicon',
            'mail_to',
            'contact_wa_vobi', 'contact_wa_seamedia', 'contact_email', 'contact_address',
            'social_instagram', 'social_tiktok', 'social_youtube',
            'seo_title', 'seo_description', 'seo_og_image',
            'nav_cta_label',
            'footer_tagline', 'footer_copyright', 'footer_columns',
        ];
    }

    protected function formSchema(): array
    {
        return [
            Section::make('Brand — Logo & Favicon')
                ->description('Logo tampil di navbar & footer. Favicon = ikon di tab browser.')
                ->columns(2)
                ->schema([
                    Forms\Components\FileUpload::make('brand_logo')->label('Logo')
                        ->image()->directory('brand')->disk('public')
                        ->helperText('PNG transparan disarankan. Kosong = pakai logo bawaan (ikon + tulisan VOBI).'),
                    Forms\Components\FileUpload::make('favicon')->label('Favicon')
                        ->image()->directory('brand')->disk('public')
                        ->helperText('Ikon tab browser. Ukuran kotak (mis. 64×64 atau 128×128) PNG/ICO.'),
                ]),

            Section::make('Kontak')
                ->description('Dipakai di footer & tombol WhatsApp.')
                ->columns(2)
                ->schema([
                    Forms\Components\TextInput::make('contact_wa_vobi')->label('WhatsApp VOBI MCN')
                        ->placeholder('6289519406185')->helperText('Format internasional tanpa +'),
                    Forms\Components\TextInput::make('contact_wa_seamedia')->label('WhatsApp SEAMEDIA')
                        ->placeholder('6282185606658'),
                    Forms\Components\TextInput::make('contact_email')->label('Email')->email(),
                    Forms\Components\TextInput::make('contact_address')->label('Alamat / Kota'),
                ]),

            Section::make('Media Sosial')
                ->columns(3)
                ->schema([
                    Forms\Components\TextInput::make('social_instagram')->label('Instagram URL')->url(),
                    Forms\Components\TextInput::make('social_tiktok')->label('TikTok URL')->url(),
                    Forms\Components\TextInput::make('social_youtube')->label('YouTube URL')->url(),
                ]),

            Section::make('Navigasi & Footer')
                ->columns(2)
                ->schema([
                    Forms\Components\TextInput::make('nav_cta_label')->label('Teks tombol nav (CTA)')
                        ->placeholder('Konsultasi →'),
                    Forms\Components\TextInput::make('footer_copyright')->label('Teks copyright')
                        ->placeholder('V.O.B.I. Group — All rights reserved.'),
                    Forms\Components\Textarea::make('footer_tagline')->label('Tagline footer')->rows(2)->columnSpanFull(),
                    Forms\Components\Repeater::make('footer_columns')->label('Kolom link footer')
                        ->schema([
                            Forms\Components\TextInput::make('title')->label('Judul kolom')->required(),
                            Forms\Components\Repeater::make('links')->label('Link')
                                ->schema([
                                    Forms\Components\TextInput::make('label')->required(),
                                    Forms\Components\TextInput::make('url')->required()->placeholder('/layanan atau https://...'),
                                ])->columns(2)->defaultItems(1),
                        ])
                        ->itemLabel(fn (array $state): ?string => $state['title'] ?? null)
                        ->collapsible()->columnSpanFull(),
                ]),

            Section::make('SEO Default & Email')
                ->columns(2)
                ->schema([
                    Forms\Components\TextInput::make('seo_title')->label('Judul default (title tag)')->columnSpanFull(),
                    Forms\Components\Textarea::make('seo_description')->label('Meta description default')->rows(2)->columnSpanFull(),
                    Forms\Components\FileUpload::make('seo_og_image')->label('OG Image default')
                        ->image()->directory('seo')->disk('public'),
                    Forms\Components\TextInput::make('mail_to')->label('Email tujuan notifikasi form')
                        ->email()->helperText('Semua submission form dikirim ke sini.'),
                ]),
        ];
    }
}
