<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CareerResource\Pages;
use App\Models\Career;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class CareerResource extends Resource
{
    protected static ?string $model = Career::class;

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';
    protected static ?string $navigationGroup = 'Konten';
    protected static ?string $navigationLabel = 'Career / Lowongan';
    protected static ?string $modelLabel = 'Lowongan';
    protected static ?string $pluralModelLabel = 'Lowongan';
    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Info Lowongan')
                ->columns(2)
                ->schema([
                    Forms\Components\TextInput::make('title')
                        ->label('Posisi / Judul')->required()->columnSpanFull()
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn (Forms\Set $set, ?string $state) => $set('slug', Str::slug((string) $state))),
                    Forms\Components\TextInput::make('slug')->required()->unique(ignoreRecord: true)
                        ->helperText('Otomatis dari judul. Dipakai di URL.'),
                    Forms\Components\TextInput::make('unit')->label('Unit / Divisi')->placeholder('VOBI MCN, SEAMEDIA, ...'),
                    Forms\Components\Select::make('type')->label('Tipe')->required()->native(false)
                        ->options([
                            'Full-time' => 'Full-time', 'Part-time' => 'Part-time',
                            'Magang' => 'Magang / Internship', 'Freelance' => 'Freelance', 'Kontrak' => 'Kontrak',
                        ])->default('Full-time'),
                    Forms\Components\Select::make('arrangement')->label('Pengaturan Kerja')->native(false)
                        ->options(['Onsite' => 'Onsite', 'Remote' => 'Remote', 'Hybrid' => 'Hybrid'])->default('Onsite'),
                    Forms\Components\TextInput::make('location')->label('Lokasi')->placeholder('Palembang'),
                    Forms\Components\TextInput::make('excerpt')->label('Ringkasan singkat')->maxLength(400)->columnSpanFull()
                        ->helperText('Tampil di kartu daftar lowongan.'),
                ]),

            Forms\Components\Section::make('Detail')
                ->schema([
                    Forms\Components\RichEditor::make('description')->label('Deskripsi pekerjaan')->columnSpanFull(),
                    Forms\Components\Repeater::make('requirements')->label('Kualifikasi')
                        ->simple(Forms\Components\TextInput::make('item')->required()->placeholder('Poin kualifikasi'))
                        ->columnSpanFull()->addActionLabel('Tambah kualifikasi'),
                ]),

            Forms\Components\Section::make('Lamaran & Status')
                ->columns(2)
                ->schema([
                    Forms\Components\TextInput::make('apply_wa')->label('No. WhatsApp lamaran')
                        ->placeholder('Kosong = pakai WA VOBI default'),
                    Forms\Components\TextInput::make('apply_email')->label('Email lamaran')->email()
                        ->placeholder('Kosong = pakai email default'),
                    Forms\Components\DatePicker::make('posted_at')->label('Tanggal dibuka')->default(now())->native(false),
                    Forms\Components\TextInput::make('sort')->label('Urutan')->numeric()->default(0),
                    Forms\Components\Toggle::make('is_open')->label('Masih dibuka')->default(true),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->label('Posisi')->searchable()->sortable()->weight('bold')
                    ->description(fn (Career $r) => trim(($r->unit ? $r->unit . ' · ' : '') . $r->type)),
                Tables\Columns\TextColumn::make('location')->label('Lokasi')->badge()->color('gray'),
                Tables\Columns\TextColumn::make('arrangement')->badge(),
                Tables\Columns\IconColumn::make('is_open')->label('Dibuka')->boolean(),
                Tables\Columns\TextColumn::make('posted_at')->label('Dibuka')->date('d M Y')->sortable(),
            ])
            ->defaultSort('sort')
            ->reorderable('sort')
            ->filters([
                Tables\Filters\TernaryFilter::make('is_open')->label('Masih dibuka'),
            ])
            ->actions([Tables\Actions\EditAction::make()])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCareers::route('/'),
            'create' => Pages\CreateCareer::route('/create'),
            'edit' => Pages\EditCareer::route('/{record}/edit'),
        ];
    }
}
