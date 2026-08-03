<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CreatorResource\Pages;
use App\Models\Creator;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class CreatorResource extends Resource
{
    protected static ?string $model = Creator::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationGroup = 'Konten';
    protected static ?string $navigationLabel = 'Creator';
    protected static ?string $modelLabel = 'Creator';
    protected static ?string $pluralModelLabel = 'Creator';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Identitas')
                ->columns(2)
                ->schema([
                    Forms\Components\TextInput::make('name')
                        ->label('Nama')
                        ->required()
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn (Forms\Set $set, ?string $state) => $set('slug', Str::slug((string) $state))),
                    Forms\Components\TextInput::make('slug')
                        ->required()
                        ->unique(ignoreRecord: true)
                        ->helperText('Otomatis dari nama. Dipakai di URL.'),
                    Forms\Components\TextInput::make('handle')
                        ->label('Handle')
                        ->placeholder('@username')
                        ->prefix('@')
                        ->dehydrateStateUsing(fn (?string $state) => $state ? ltrim($state, '@') : null),
                    Forms\Components\TextInput::make('city')->label('Kota'),
                    Forms\Components\Select::make('category')
                        ->label('Kategori')
                        ->required()
                        ->options([
                            'Beauty' => 'Beauty', 'Fashion' => 'Fashion', 'F&B' => 'F&B',
                            'Home Living' => 'Home Living', 'Mom & Baby' => 'Mom & Baby',
                            'Electronic' => 'Electronic', 'Lifestyle' => 'Lifestyle', 'Tech' => 'Tech',
                        ])
                        ->createOptionForm([Forms\Components\TextInput::make('category')])
                        ->native(false),
                    Forms\Components\Select::make('platform')
                        ->label('Platform')
                        ->required()
                        ->options(['TikTok' => 'TikTok', 'Shopee' => 'Shopee', 'YouTube' => 'YouTube', 'Instagram' => 'Instagram'])
                        ->native(false),
                ]),

            Forms\Components\Section::make('Metrik')
                ->columns(2)
                ->schema([
                    Forms\Components\TextInput::make('followers')
                        ->label('Followers')
                        ->numeric()->required()->default(0)
                        ->live(onBlur: true)
                        ->helperText(fn (?int $state) => 'Tier otomatis: ' . static::tierOf((int) $state)),
                    Forms\Components\TextInput::make('engagement_rate')
                        ->label('Engagement Rate (%)')
                        ->numeric()->required()->default(0)->suffix('%'),
                    Forms\Components\TextInput::make('gmv_3m')
                        ->label('GMV 3 bulan')
                        ->numeric()->required()->default(0)->prefix('Rp'),
                    Forms\Components\TextInput::make('price_from')
                        ->label('Harga mulai dari')
                        ->numeric()->required()->default(0)->prefix('Rp'),
                ]),

            Forms\Components\Section::make('Profil & Media')
                ->columns(2)
                ->schema([
                    Forms\Components\FileUpload::make('avatar')
                        ->label('Foto / Avatar')
                        ->image()
                        ->imageEditor()
                        ->directory('creators')
                        ->disk('public')
                        ->helperText('Kosongkan untuk pakai gambar bawaan.'),
                    Forms\Components\Group::make([
                        Forms\Components\Toggle::make('is_active')->label('Aktif (tampil di web)')->default(true),
                        Forms\Components\Toggle::make('is_featured')->label('Featured (kartu unggulan)')->default(false),
                    ]),
                    Forms\Components\Textarea::make('sow')
                        ->label('SOW / Deliverables')->rows(3)->columnSpanFull(),
                    Forms\Components\Textarea::make('bio')
                        ->label('Bio')->rows(3)->columnSpanFull(),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('avatar')
                    ->label('')
                    ->circular()
                    ->getStateUsing(fn (Creator $r) => $r->avatar_url),
                Tables\Columns\TextColumn::make('name')->label('Nama')->searchable()->sortable()
                    ->description(fn (Creator $r) => $r->handle ? '@' . ltrim($r->handle, '@') : null),
                Tables\Columns\TextColumn::make('category')->label('Kategori')->badge()->searchable(),
                Tables\Columns\TextColumn::make('platform')->badge()->color('gray'),
                Tables\Columns\TextColumn::make('tier')->badge()
                    ->color(fn (string $state) => match ($state) {
                        'Mega' => 'warning', 'Macro' => 'success', 'Mid' => 'info', default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('followers')->label('Followers')->sortable()
                    ->formatStateUsing(fn ($state) => Creator::shortNumber((int) $state)),
                Tables\Columns\TextColumn::make('gmv_3m')->label('GMV 3bln')->sortable()
                    ->formatStateUsing(fn ($state) => 'Rp ' . Creator::shortRupiah((int) $state)),
                Tables\Columns\IconColumn::make('is_featured')->label('Featured')->boolean(),
                Tables\Columns\IconColumn::make('is_active')->label('Aktif')->boolean(),
            ])
            ->defaultSort('is_featured', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('category')
                    ->options(fn () => Creator::query()->distinct()->pluck('category', 'category')->toArray()),
                Tables\Filters\SelectFilter::make('platform')
                    ->options(['TikTok' => 'TikTok', 'Shopee' => 'Shopee', 'YouTube' => 'YouTube', 'Instagram' => 'Instagram']),
                Tables\Filters\TernaryFilter::make('is_featured')->label('Featured'),
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

    protected static function tierOf(int $f): string
    {
        return match (true) {
            $f >= 1_000_000 => 'Mega',
            $f >= 250_000   => 'Macro',
            $f >= 50_000    => 'Mid',
            default         => 'Micro',
        };
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCreators::route('/'),
            'create' => Pages\CreateCreator::route('/create'),
            'edit' => Pages\EditCreator::route('/{record}/edit'),
        ];
    }
}
