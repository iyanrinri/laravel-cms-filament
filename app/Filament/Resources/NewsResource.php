<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NewsResource\Pages;
use App\Filament\Resources\NewsResource\RelationManagers;
use App\Models\Category;
use App\Models\News;
use App\Models\Tag;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class NewsResource extends Resource
{
    protected static ?string $model = News::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Basic Information')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(function (string $operation, $state, Forms\Set $set, Forms\Get $get) {
                                $slug = str()->slug($state);
                                $item = News::query()->where('slug', $slug)->first();
                                if ($item) {
                                    $operation === 'create' ? $set('slug', $slug . '-' . uniqid()) : null;
                                } else {
                                    $operation === 'create' ? $set('slug', $slug) : null;
                                }
                            }),

                        Forms\Components\TextInput::make('slug')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true),

                        Forms\Components\Select::make('category_id')
                            ->label('Category')
                            ->options(function () {
                                return cache()->memo()->remember(Category::CACHE_KEYS['dropdown'], 60 * 60, function () {
                                    return Category::query()->get()->pluck('name', 'id')->toArray();
                                });
                            })
                            ->searchable()
                            ->preload()
                            ->required()
                            ->createOptionForm(CategoryResource::createForm()),
                    ])->columns(2),

                Section::make('Details')
                    ->schema([
                        Forms\Components\FileUpload::make('image')
                            ->image()
                            ->directory('news/images')
                            ->maxSize(1024)
                            ->columnSpanFull(),

                        Forms\Components\RichEditor::make('content')
                            ->required()
                            ->columnSpanFull(),

                        Forms\Components\Select::make('tags')
                            ->label('Tags')
                            ->multiple()
                            ->relationship('tags', 'name') // pakai relasi many-to-many
                            ->preload()
                            ->searchable()
                            ->required(false)
                            ->createOptionForm(TagResource::createForm())
                            ->maxItems(10)
                            ->columnSpanFull(),
                    ])->columns(2),

                Section::make('Publication Details')
                    ->schema([
                        Forms\Components\Select::make('status')
                            ->options([
                                'draft' => 'Draft',
                                'active' => 'Active',
                                'expired' => 'Expired',
                                'filled' => 'Position Filled',
                            ])
                            ->default('active')
                            ->required(),
                        Forms\Components\DateTimePicker::make('published_at')
                            ->default(date('Y-m-d H:i:s'))
                            ->required(),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('slug')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('category.name')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'danger' => 'expired',
                        'warning' => 'draft',
                        'success' => 'active',
                        'gray' => 'filled',
                    ]),
            ])
            ->filters([
                //
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

    public static function getRelations(): array
    {
        return [
//            RelationManagers\TagsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListNews::route('/'),
            'create' => Pages\CreateNews::route('/create'),
            'edit' => Pages\EditNews::route('/{record}/edit'),
        ];
    }
}
