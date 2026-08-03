<?php

namespace App\Filament\Pages;

use App\Filament\Pages\Concerns\SettingsPage;
use Filament\Forms;
use Filament\Forms\Components\Section;

class ManageEkosistem extends SettingsPage
{
    protected static ?string $navigationIcon = 'heroicon-o-map';
    protected static ?string $navigationGroup = 'Tampilan Situs';
    protected static ?string $navigationLabel = 'Halaman Ekosistem';
    protected static ?string $title = 'Edit Halaman Ekosistem';
    protected static ?int $navigationSort = 3;

    protected function keys(): array
    {
        return [
            'eko_welcome', 'eko_title', 'eko_sub', 'eko_stops',
            'eko_finale_kicker', 'eko_finale_line', 'eko_finale_stats',
            'eko_units', 'eko_values', 'eko_listening_quote',
            'eko_final_eyebrow', 'eko_final_title', 'eko_final_text',
        ];
    }

    protected function formSchema(): array
    {
        return [
            Section::make('Intro')->columns(2)->schema([
                Forms\Components\TextInput::make('eko_welcome')->label('Welcome (kicker)'),
                Forms\Components\TextInput::make('eko_title')->label('Judul')->helperText('*kata* jadi amber'),
                Forms\Components\Textarea::make('eko_sub')->label('Subjudul')->rows(2)->columnSpanFull(),
            ]),

            Section::make('Perjalanan (Journey Stops)')
                ->description('Ikon medali mengikuti urutan (maks 5 stop bawaan). *kata* pada headline jadi amber.')
                ->schema([
                    Forms\Components\Repeater::make('eko_stops')->label('Stop')
                        ->schema([
                            Forms\Components\TextInput::make('city')->label('Label kecil')->required(),
                            Forms\Components\TextInput::make('lh')->label('Headline')->helperText('*kata* jadi amber'),
                            Forms\Components\Textarea::make('ld')->label('Deskripsi')->rows(2),
                        ])
                        ->itemLabel(fn (array $state): ?string => $state['city'] ?? null)
                        ->collapsed()->columnSpanFull(),
                ]),

            Section::make('Finale')->columns(2)->schema([
                Forms\Components\TextInput::make('eko_finale_kicker')->label('Kicker atas'),
                Forms\Components\TextInput::make('eko_finale_line')->label('Baris besar')->helperText('*kata* jadi amber'),
                Forms\Components\Repeater::make('eko_finale_stats')->label('Angka')
                    ->schema([
                        Forms\Components\TextInput::make('value')->label('Angka')->required()->placeholder('600'),
                        Forms\Components\TextInput::make('suffix')->label('Akhiran')->placeholder('+'),
                        Forms\Components\TextInput::make('label')->label('Label')->required(),
                    ])
                    ->itemLabel(fn (array $state): ?string => $state['label'] ?? null)
                    ->grid(2)->collapsed()->columnSpanFull(),
            ]),

            Section::make('Unit & Spirit')->schema([
                Forms\Components\Repeater::make('eko_units')->label('Baris unit')
                    ->schema([
                        Forms\Components\TextInput::make('uf')->label('Fokus'),
                        Forms\Components\TextInput::make('un')->label('Nama unit')->required(),
                        Forms\Components\TextInput::make('url')->label('Link')->placeholder('/layanan'),
                    ])
                    ->itemLabel(fn (array $state): ?string => $state['un'] ?? null)
                    ->grid(2)->collapsed()->columnSpanFull(),
                Forms\Components\TagsInput::make('eko_values')->label('Kata VOBI Spirit')
                    ->placeholder('Honesty, Trust, ...')->columnSpanFull(),
                Forms\Components\Textarea::make('eko_listening_quote')->label('Kutipan Listening Strategy')
                    ->rows(2)->helperText('*kata* jadi amber')->columnSpanFull(),
            ]),

            Section::make('Final CTA')->columns(3)->schema([
                Forms\Components\TextInput::make('eko_final_eyebrow')->label('Eyebrow'),
                Forms\Components\TextInput::make('eko_final_title')->label('Judul')->helperText('*amber* & <br>'),
                Forms\Components\TextInput::make('eko_final_text')->label('Teks'),
            ]),
        ];
    }
}
