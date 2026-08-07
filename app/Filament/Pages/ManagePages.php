<?php

namespace App\Filament\Pages;

use App\Filament\Pages\Concerns\SettingsPage;
use Filament\Forms;
use Filament\Forms\Components\Section;

class ManagePages extends SettingsPage
{
    protected static ?string $navigationIcon = 'heroicon-o-document-duplicate';
    protected static ?string $navigationGroup = 'Tampilan Situs';
    protected static ?string $navigationLabel = 'Kontak / Gabung / Blog';
    protected static ?string $title = 'Edit Halaman Kontak, Gabung & Blog';
    protected static ?int $navigationSort = 5;

    protected function keys(): array
    {
        return [
            'kontak_eyebrow', 'kontak_heading', 'kontak_lead', 'kontak_address', 'kontak_hours',
            'gabung_eyebrow', 'gabung_heading', 'gabung_lead', 'gabung_creator_note', 'gabung_brand_note',
            'blog_eyebrow', 'blog_heading',
            'career_eyebrow', 'career_heading', 'career_lead',
        ];
    }

    protected function formSchema(): array
    {
        return [
            Section::make('Halaman Kontak')->columns(2)->schema([
                Forms\Components\TextInput::make('kontak_eyebrow')->label('Eyebrow'),
                Forms\Components\TextInput::make('kontak_heading')->label('Judul')->helperText('*amber* & <br>'),
                Forms\Components\Textarea::make('kontak_lead')->label('Lead')->rows(2)->columnSpanFull(),
                Forms\Components\Textarea::make('kontak_address')->label('Alamat kantor')->rows(2),
                Forms\Components\TextInput::make('kontak_hours')->label('Jam operasional'),
            ]),

            Section::make('Halaman Cara Gabung')->columns(2)->schema([
                Forms\Components\TextInput::make('gabung_eyebrow')->label('Eyebrow'),
                Forms\Components\TextInput::make('gabung_heading')->label('Judul')->helperText('*amber* & <br>'),
                Forms\Components\Textarea::make('gabung_lead')->label('Lead')->rows(2)->columnSpanFull(),
                Forms\Components\Textarea::make('gabung_creator_note')->label('Catatan tab Creator')->rows(2),
                Forms\Components\Textarea::make('gabung_brand_note')->label('Catatan tab Brand')->rows(2),
            ]),

            Section::make('Halaman Blog')->columns(2)->schema([
                Forms\Components\TextInput::make('blog_eyebrow')->label('Eyebrow'),
                Forms\Components\TextInput::make('blog_heading')->label('Judul'),
            ]),

            Section::make('Halaman Career')->columns(2)->schema([
                Forms\Components\TextInput::make('career_eyebrow')->label('Eyebrow'),
                Forms\Components\TextInput::make('career_heading')->label('Judul')->helperText('*amber* & <br>'),
                Forms\Components\Textarea::make('career_lead')->label('Lead')->rows(2)->columnSpanFull(),
            ]),
        ];
    }
}
