<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CampaignResource\Pages;
use App\Models\Campaign;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class CampaignResource extends Resource
{
    protected static ?string $model = Campaign::class;

    protected static ?string $navigationIcon = 'heroicon-o-megaphone';
    protected static ?string $navigationGroup = 'Konten';
    protected static ?string $navigationLabel = 'Campaign';
    protected static ?string $modelLabel = 'Campaign';
    protected static ?string $pluralModelLabel = 'Campaign';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Informasi Campaign')
                ->columns(2)
                ->schema([
                    Forms\Components\TextInput::make('title')
                        ->label('Judul')->required()->columnSpanFull()
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn (Forms\Set $set, ?string $state) => $set('slug', Str::slug((string) $state))),
                    Forms\Components\TextInput::make('slug')
                        ->required()->unique(ignoreRecord: true)
                        ->helperText('Otomatis dari judul. Dipakai di URL.'),
                    Forms\Components\TextInput::make('subtitle')->label('Subjudul')->maxLength(255),
                    Forms\Components\TextInput::make('category')->label('Kategori / Niche')->required(),
                    Forms\Components\TextInput::make('service')->label('Layanan')->required()
                        ->placeholder('Video + Live, Affiliate, dll'),
                    Forms\Components\TextInput::make('creator_name')->label('Unit / Kreator terkait')
                        ->placeholder('VOBI MCN'),
                    Forms\Components\TextInput::make('performance')->label('Ringkasan performa')
                        ->placeholder('3,1x ROI'),
                    Forms\Components\TextInput::make('price')->label('Harga paket')
                        ->numeric()->required()->default(0)->prefix('Rp'),
                    Forms\Components\FileUpload::make('image')
                        ->label('Gambar')->image()->imageEditor()
                        ->directory('campaigns')->disk('public')->columnSpanFull(),
                ]),

            Forms\Components\Section::make('Isi Paket (Deliverables)')
                ->description('Tiap grup = satu pilihan / paket. Tambah item di dalamnya.')
                ->schema([
                    Forms\Components\Repeater::make('details')
                        ->label('Grup Deliverables')
                        ->schema([
                            Forms\Components\TextInput::make('label')->label('Judul grup')->required(),
                            Forms\Components\TagsInput::make('items')->label('Item')
                                ->placeholder('Ketik lalu Enter')->required(),
                        ])
                        ->itemLabel(fn (array $state): ?string => $state['label'] ?? null)
                        ->collapsible()->cloneable()->defaultItems(1)->columnSpanFull(),
                    Forms\Components\Textarea::make('sow')->label('SOW (opsional, teks bebas)')->rows(2)->columnSpanFull(),
                    Forms\Components\TextInput::make('note')->label('Catatan kecil')->columnSpanFull(),
                    Forms\Components\TagsInput::make('highlights')->label('Highlight / kenapa paket ini')
                        ->placeholder('Ketik lalu Enter')->columnSpanFull(),
                ]),

            Forms\Components\Section::make('Masa Berlaku & Status')
                ->columns(3)
                ->schema([
                    Forms\Components\Toggle::make('is_active')->label('Aktif')->default(true)->inline(false),
                    Forms\Components\DatePicker::make('starts_at')->label('Mulai')
                        ->default(now())->native(false),
                    Forms\Components\DatePicker::make('ends_at')->label('Berakhir')
                        ->default(now()->addMonth())->native(false)
                        ->helperText('Default +1 bulan. Lewat tanggal ini campaign otomatis hilang dari web.'),
                ]),

            Forms\Components\Section::make('PIC (Penanggung Jawab)')
                ->description('Tidak tampil di web. Dikirim ke email saat ada pengajuan campaign ini.')
                ->columns(3)
                ->schema([
                    Forms\Components\TextInput::make('pic_name')->label('Nama PIC'),
                    Forms\Components\TextInput::make('pic_phone')->label('No. WhatsApp PIC'),
                    Forms\Components\TextInput::make('pic_email')->label('Email PIC')->email(),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label('')->getStateUsing(fn (Campaign $r) => $r->image_url),
                Tables\Columns\TextColumn::make('title')->label('Judul')->searchable()->sortable()
                    ->description(fn (Campaign $r) => $r->creator_name),
                Tables\Columns\TextColumn::make('category')->badge(),
                Tables\Columns\TextColumn::make('price')->label('Harga')->sortable()
                    ->formatStateUsing(fn ($state) => 'Rp ' . \App\Models\Creator::shortRupiah((int) $state)),
                Tables\Columns\TextColumn::make('status')->badge()
                    ->color(fn (string $state) => match ($state) {
                        'Aktif' => 'success', 'Terjadwal' => 'info', 'Berakhir' => 'danger', default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('ends_at')->label('Berakhir')->date('d M Y')->sortable()
                    ->description(fn (Campaign $r) => $r->is_live && $r->days_left !== null
                        ? 'sisa ' . $r->days_left . ' hari' : null),
                Tables\Columns\TextColumn::make('pic_name')->label('PIC')->placeholder('—')->toggleable(),
            ])
            ->defaultSort('ends_at', 'desc')
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active')->label('Aktif'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCampaigns::route('/'),
            'create' => Pages\CreateCampaign::route('/create'),
            'edit' => Pages\EditCampaign::route('/{record}/edit'),
        ];
    }
}
