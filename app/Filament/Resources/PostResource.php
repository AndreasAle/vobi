<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Models\Post;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';
    protected static ?string $navigationGroup = 'Konten';
    protected static ?string $navigationLabel = 'Artikel / Blog';
    protected static ?string $modelLabel = 'Artikel';
    protected static ?string $pluralModelLabel = 'Artikel';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make()
                ->columns(2)
                ->schema([
                    Forms\Components\TextInput::make('title')
                        ->label('Judul')->required()->columnSpanFull()
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn (Forms\Set $set, ?string $state) => $set('slug', Str::slug((string) $state))),
                    Forms\Components\TextInput::make('slug')
                        ->required()->unique(ignoreRecord: true)
                        ->helperText('Otomatis dari judul. Dipakai di URL.'),
                    Forms\Components\TextInput::make('category')->label('Kategori')->required()
                        ->placeholder('Creator Tips, Marketplace, ...'),
                    Forms\Components\Textarea::make('excerpt')->label('Ringkasan (excerpt)')
                        ->rows(2)->maxLength(400)->columnSpanFull()
                        ->helperText('Tampil di kartu & meta description.'),
                    Forms\Components\FileUpload::make('image')
                        ->label('Cover')->image()->imageEditor()
                        ->directory('posts')->disk('public')->columnSpanFull(),
                ]),

            Forms\Components\Section::make('Isi Artikel')
                ->schema([
                    Forms\Components\RichEditor::make('body')
                        ->label('Konten')->required()->columnSpanFull()
                        ->fileAttachmentsDisk('public')
                        ->fileAttachmentsDirectory('posts/inline'),
                ]),

            Forms\Components\Section::make('Publikasi')
                ->columns(3)
                ->schema([
                    Forms\Components\Toggle::make('is_published')->label('Terbit')->default(true)->inline(false),
                    Forms\Components\DateTimePicker::make('published_at')->label('Tanggal terbit')
                        ->default(now())->native(false),
                    Forms\Components\TextInput::make('read_min')->label('Estimasi baca (menit)')
                        ->numeric()->default(4),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label('')->getStateUsing(fn (Post $r) => $r->image_url),
                Tables\Columns\TextColumn::make('title')->label('Judul')->searchable()->sortable()->wrap(),
                Tables\Columns\TextColumn::make('category')->badge()->searchable(),
                Tables\Columns\IconColumn::make('is_published')->label('Terbit')->boolean(),
                Tables\Columns\TextColumn::make('published_at')->label('Tgl terbit')->dateTime('d M Y')->sortable(),
            ])
            ->defaultSort('published_at', 'desc')
            ->filters([
                Tables\Filters\TernaryFilter::make('is_published')->label('Terbit'),
                Tables\Filters\SelectFilter::make('category')
                    ->options(fn () => Post::query()->distinct()->pluck('category', 'category')->toArray()),
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
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
