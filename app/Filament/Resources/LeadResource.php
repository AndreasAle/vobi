<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LeadResource\Pages;
use App\Models\Lead;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class LeadResource extends Resource
{
    protected static ?string $model = Lead::class;

    protected static ?string $navigationIcon = 'heroicon-o-inbox-arrow-down';
    protected static ?string $navigationGroup = 'Masuk';
    protected static ?string $navigationLabel = 'Leads / Pesan';
    protected static ?string $modelLabel = 'Lead';
    protected static ?string $pluralModelLabel = 'Leads';

    protected static array $typeLabels = [
        'creator' => 'Daftar Creator',
        'brand' => 'Kerjasama Brand',
        'consultation' => 'Konsultasi',
        'marketplace' => 'Ajak Kreator',
        'campaign' => 'Pengajuan Campaign',
    ];

    protected static array $statusLabels = [
        'baru' => 'Baru',
        'diproses' => 'Diproses',
        'selesai' => 'Selesai',
    ];

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Detail Pesan')
                ->columns(2)
                ->schema([
                    Forms\Components\TextInput::make('name')->label('Nama')->disabled(),
                    Forms\Components\TextInput::make('type')->label('Tipe')->disabled()
                        ->formatStateUsing(fn (?string $s) => static::$typeLabels[$s] ?? $s),
                    Forms\Components\TextInput::make('email')->label('Email')->disabled(),
                    Forms\Components\TextInput::make('phone')->label('WhatsApp')->disabled(),
                    Forms\Components\TextInput::make('subject')->label('Subjek')->disabled()->columnSpanFull(),
                    Forms\Components\Textarea::make('message')->label('Pesan')->disabled()->rows(4)->columnSpanFull(),
                    Forms\Components\KeyValue::make('meta')->label('Data tambahan')->disabled()->columnSpanFull(),
                ]),
            Forms\Components\Section::make('Tindak Lanjut')
                ->schema([
                    Forms\Components\Select::make('status')->label('Status')
                        ->options(static::$statusLabels)->default('baru')->native(false),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('created_at')->label('Masuk')->dateTime('d M Y H:i')->sortable(),
                Tables\Columns\TextColumn::make('type')->label('Tipe')->badge()
                    ->formatStateUsing(fn (?string $s) => static::$typeLabels[$s] ?? $s),
                Tables\Columns\TextColumn::make('name')->label('Nama')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('subject')->label('Subjek')->limit(40)->searchable()->wrap(),
                Tables\Columns\TextColumn::make('phone')->label('WhatsApp')->searchable(),
                Tables\Columns\TextColumn::make('status')->label('Status')->badge()
                    ->formatStateUsing(fn (?string $s) => static::$statusLabels[$s] ?? ($s ?: 'Baru'))
                    ->color(fn (?string $s) => match ($s) {
                        'selesai' => 'success', 'diproses' => 'warning', default => 'gray',
                    }),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('type')->label('Tipe')->options(static::$typeLabels),
                Tables\Filters\SelectFilter::make('status')->label('Status')->options(static::$statusLabels),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make()->label('Status'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function getNavigationBadge(): ?string
    {
        return (string) Lead::query()->where(fn ($q) => $q->where('status', 'baru')->orWhereNull('status'))->count();
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLeads::route('/'),
            'edit' => Pages\EditLead::route('/{record}/edit'),
        ];
    }
}
