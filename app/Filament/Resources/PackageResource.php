<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PackageResource\Pages;
use App\Models\Package;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class PackageResource extends Resource
{
    protected static ?string $model = Package::class;

    protected static ?string $navigationIcon = 'heroicon-o-gift';

    protected static ?string $navigationLabel = 'Travel Packages';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $navigationGroup = 'Package Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make('Package Information')
                    ->tabs([
                        Tabs\Tab::make('Basic Details')
                            ->icon('heroicon-o-information-circle')
                            ->schema([
                                Section::make('Package Identity')
                                    ->description('Basic information about the package')
                                    ->schema([
                                        TextInput::make('name')
                                            ->required()
                                            ->maxLength(255)
                                            ->placeholder('Luxury Beach Retreat')
                                            ->helperText('A descriptive name for your package')
                                            ->columnSpan(['default' => 1, 'md' => 2]),

                                        TextInput::make('slug')
                                            ->required()
                                            ->maxLength(255)
                                            ->unique(ignoreRecord: true)
                                            ->placeholder('luxury-beach-retreat')
                                            ->helperText('Used in URLs. Use lowercase letters, numbers, and hyphens only')
                                            ->columnSpan(['default' => 1, 'md' => 1])
                                            ->afterStateUpdated(function (string $state, callable $set, $get) {
                                                if (! $get('is_slug_changed_manually') && filled($get('name'))) {
                                                    $set('slug', str($state)->slug());
                                                }
                                            }),
                                    ])
                                    ->columns(3),

                                Grid::make()
                                    ->schema([
                                        Section::make('Classification')
                                            ->schema([
                                                Select::make('category_id')
                                                    ->relationship('category', 'name')
                                                    ->preload()
                                                    ->searchable()
                                                    ->live()
                                                    ->required()
                                                    ->helperText('Select the type of package')
                                                    ->placeholder('Select a category'),

                                                Select::make('location_id')
                                                    ->relationship('location', 'name')
                                                    ->preload()
                                                    ->searchable()
                                                    ->live()
                                                    ->required()
                                                    ->helperText('Where this package is located')
                                                    ->placeholder('Select a location'),
                                            ]),

                                        Section::make('Pricing')
                                            ->schema([
                                                TextInput::make('price')
                                                    ->numeric()
                                                    ->required()
                                                    ->prefix('$')
                                                    ->placeholder('299.99')
                                                    ->helperText('Base price per person'),

                                                TextInput::make('duration')
                                                    ->numeric()
                                                    ->suffix('days')
                                                    ->placeholder('7')
                                                    ->helperText('Length of the package stay'),
                                            ]),
                                    ])
                                    ->columns(2),
                            ]),

                        Tabs\Tab::make('Description & Details')
                            ->icon('heroicon-o-document-text')
                            ->schema([
                                Section::make()
                                    ->schema([
                                        RichEditor::make('description')
                                            ->toolbarButtons([
                                                'blockquote',
                                                'bold',
                                                'bulletList',
                                                'heading',
                                                'italic',
                                                'link',
                                                'orderedList',
                                                'redo',
                                                'strike',
                                                'undo',
                                            ])
                                            ->placeholder('Describe the experience, attractions, and benefits of this package')
                                            ->helperText('Use rich formatting to make your description engaging')
                                            ->fileAttachmentsDirectory('packages/attachments')
                                            ->columnSpan('full'),
                                    ]),

                                Section::make('Package Highlights')
                                    ->schema([
                                        TextInput::make('max_guests')
                                            ->numeric()
                                            ->placeholder('4')
                                            ->helperText('Maximum number of guests per booking'),

                                        TextInput::make('min_age')
                                            ->numeric()
                                            ->placeholder('18')
                                            ->helperText('Minimum age requirement, if any'),
                                    ])
                                    ->columns(2),
                            ]),

                        Tabs\Tab::make('Images')
                            ->icon('heroicon-o-photo')
                            ->schema([
                                Section::make('Featured Images')
                                    ->description('Primary images shown in search results and headers')
                                    ->schema([
                                        FileUpload::make('images')
                                            ->image()
                                            ->multiple()
                                            ->maxFiles(5)
                                            ->directory('packages/images')
                                            ->helperText('Upload up to 5 high-quality feature images (16:9 ratio recommended)')
                                            ->imageResizeMode('cover')
                                            ->imageResizeTargetWidth('1200')
                                            ->imageResizeTargetHeight('800')
                                            ->columnSpan('full'),
                                    ]),

                                Section::make('Gallery')
                                    ->description('Additional images showcasing the experience')
                                    ->schema([
                                        FileUpload::make('gallery')
                                            ->image()
                                            ->multiple()
                                            ->directory('packages/gallery')
                                            ->helperText('Upload additional images showing various aspects of the package')
                                            ->imageResizeMode('cover')
                                            ->imageResizeTargetWidth('1000')
                                            ->imageResizeTargetHeight('1000')
                                            ->columnSpan('full'),
                                    ]),
                            ]),

                        Tabs\Tab::make('Amenities & Features')
                            ->icon('heroicon-o-heart')
                            ->schema([
                                Grid::make()
                                    ->schema([
                                        Section::make('Accommodation')
                                            ->schema([
                                                Select::make('rooms')
                                                    ->relationship('rooms', 'name')
                                                    ->preload()
                                                    ->live()
                                                    ->multiple()
                                                    ->searchable()
                                                    ->helperText('Types of rooms included')
                                                    ->placeholder('Select available room types'),

                                                Select::make('amenities')
                                                    ->relationship('amenities', 'name')
                                                    ->preload()
                                                    ->live()
                                                    ->multiple()
                                                    ->searchable()
                                                    ->helperText('Amenities provided with this package')
                                                    ->placeholder('Select amenities'),
                                            ]),

                                        Section::make('Experience')
                                            ->schema([
                                                Select::make('activities')
                                                    ->relationship('activities', 'name')
                                                    ->preload()
                                                    ->live()
                                                    ->multiple()
                                                    ->searchable()
                                                    ->helperText('Activities included in this package')
                                                    ->placeholder('Select activities'),

                                                Select::make('features')
                                                    ->relationship('features', 'name')
                                                    ->preload()
                                                    ->live()
                                                    ->multiple()
                                                    ->searchable()
                                                    ->helperText('Special features or highlights')
                                                    ->placeholder('Select unique features'),
                                            ]),
                                    ])
                                    ->columns(2),
                            ]),
                    ])
                    ->columnSpan('full'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->limit(30),
//                    ->tooltip(function (TextColumn $column): ?string {
//                        $state = $column->getState();
//                        if (strlen($state) <= $column->getLimit()) {
//                            return null;
//                        }
//                        return $state;
//                    }),

                TextColumn::make('category.name')
                    ->label('Category')
                    ->badge()
                    ->color('success'),

                TextColumn::make('location.name')
                    ->label('Location')
                    ->badge()
                    ->color('info'),

                TextColumn::make('price')
                    ->money('usd')
                    ->sortable(),

                TextColumn::make('duration')
                    ->suffix(' days')
                    ->sortable(),

                TextColumn::make('updated_at')
                    ->dateTime('M j, Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('updated_at', 'desc')
            ->filters([
                SelectFilter::make('category')
                    ->relationship('category', 'name'),
                SelectFilter::make('location')
                    ->relationship('location', 'name'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPackages::route('/'),
            'create' => Pages\CreatePackage::route('/create'),
            'edit' => Pages\EditPackage::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
}
