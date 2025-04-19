<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RoomResource\Pages;
use App\Filament\Resources\RoomResource\RelationManagers;
use App\Models\Room;
use App\Models\Category;
use App\Models\Location;
use App\Models\RoomLink;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Card;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class RoomResource extends Resource
{
    protected static ?string $model = Room::class;

    protected static ?string $navigationIcon = 'heroicon-o-home';

    protected static ?int $navigationSort = 3;
    protected static ?string $navigationLabel = 'Accommodations';

    protected static ?string $navigationGroup = 'Variables';
    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Tabs::make('Room Details')
                    ->tabs([
                        Tab::make('Basic Information')
                            ->schema([
                                Section::make()
                                    ->description('Enter the essential details about this accommodation')
                                    ->schema([
                                        Grid::make(2)
                                            ->schema([
                                                TextInput::make('name')
                                                    ->required()
                                                    ->maxLength(255)
                                                    ->placeholder('e.g., Deluxe Ocean Suite, Mountain View Villa')
                                                    ->helperText('The name of this accommodation type'),

                                                Select::make('parent_id')
                                                    ->relationship('parent', 'name')
                                                    ->nullable()
                                                    ->placeholder('Select a parent room (if applicable)')
                                                    ->helperText('Use this to create a room hierarchy (e.g., Suite → Deluxe Suite)'),
                                            ]),

                                        Grid::make(2)
                                            ->schema([
                                                TextInput::make('capacity')
                                                    ->numeric()
                                                    ->minValue(1)
                                                    ->placeholder('e.g., 2')
                                                    ->suffix('guests')
                                                    ->helperText('Maximum number of guests allowed'),

                                                TextInput::make('size')
                                                    ->numeric()
                                                    ->minValue(1)
                                                    ->placeholder('e.g., 45')
                                                    ->suffix('m²')
                                                    ->helperText('Room size in square meters'),
                                            ]),
                                    ]),
                            ]),

                        Tab::make('Visual Elements')
                            ->schema([
                                Section::make()
                                    ->description('Upload visuals to represent this accommodation')
                                    ->schema([
                                        FileUpload::make('icon')
                                            ->image()
                                            ->directory('icons')
                                            ->imageResizeMode('cover')
                                            ->imageCropAspectRatio('1:1')
                                            ->imageResizeTargetWidth('120')
                                            ->imageResizeTargetHeight('120')
                                            ->helperText('Upload a square icon or symbol (recommended: 120x120px)'),

                                        FileUpload::make('images')
                                            ->image()
                                            ->multiple()
                                            ->reorderable()
                                            ->directory('rooms/images')
                                            ->helperText('High-quality photos of the accommodation (recommended: 1600x900px)'),
                                    ]),
                            ]),

                        Tab::make('Details & Features')
                            ->schema([
                                Section::make()
                                    ->description('Provide comprehensive information about this accommodation')
                                    ->schema([
                                        RichEditor::make('description')
                                            ->required()
                                            ->placeholder('Describe the accommodation, including its unique features, views, amenities, and decor...')
                                            ->helperText('Detailed description with formatting')
                                            ->fileAttachmentsDisk('public')
                                            ->fileAttachmentsDirectory('storage/rooms/attachments')
                                            ->toolbarButtons([
                                                'blockquote',
                                                'bold',
                                                'bulletList',
                                                'h3',
                                                'italic',
                                                'link',
                                                'orderedList',
                                                'redo',
                                                'strike',
                                                'undo',
                                            ]),

                                        Grid::make(2)
                                            ->schema([
                                                TextInput::make('price_per_night')
                                                    ->numeric()
                                                    ->prefix('$')
                                                    ->placeholder('e.g., 299.99')
                                                    ->helperText('Starting price per night in USD')
                                                    ->columnSpanFull(),
                                            ]),
                                    ]),
                            ]),

                        Tab::make('Accommodation Links')
                            ->schema([
                                Section::make('Category & Location Associations')
                                    ->description('Link this accommodation to categories and locations')
                                    ->schema([
                                        Repeater::make('roomLinks')
                                            ->relationship('roomLinks')
                                            ->schema([
                                                Select::make('category_id')
                                                    ->label('Category')
                                                    ->options(function () {
                                                        return Category::all()->pluck('name', 'id');
                                                    })
                                                    ->searchable()
                                                    ->preload()
                                                    ->required()
                                                    ->helperText('Select a category for this accommodation'),

                                                Select::make('location_id')
                                                    ->label('Location')
                                                    ->options(function () {
                                                        return Location::all()->pluck('name', 'id');
                                                    })
                                                    ->searchable()
                                                    ->preload()
                                                    ->required()
                                                    ->helperText('Select a location for this accommodation'),

                                                Hidden::make('room_id')
                                                    ->default(function (callable $get, ?Model $record) {
                                                        return $record ? $record->id : null;
                                                    }),
                                            ])
                                            ->columns(2)
                                            ->itemLabel(function (array $state): ?string {
                                                $categoryName = Category::find($state['category_id'])->name ?? '(No category)';
                                                $locationName = Location::find($state['location_id'])->name ?? '(No location)';
                                                return "{$categoryName} - {$locationName}";
                                            })
                                            ->addActionLabel('Add Association')
                                            ->reorderableWithButtons()
                                            ->collapsible()
                                            ->collapseAllAction(
                                                fn (Forms\Components\Actions\Action $action) => $action->label('Collapse All')
                                            )
                                            ->reorderable(false),
                                    ]),
                            ]),
                    ])
                    ->columnSpanFull()
                    ->activeTab(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('icon')
                    ->circular()
                    ->size(40),

                TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                TextColumn::make('parent.name')
                    ->label('Parent Room')
                    ->color('gray'),

                TextColumn::make('capacity')
                    ->suffix(' guests')
                    ->sortable(),

                TextColumn::make('size')
                    ->suffix(' m²')
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('price_per_night')
                    ->label('Price Per Night')
                    ->money('usd')
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('roomLinks.count')
                    ->label('Links')
                    ->badge()
                    ->color('success')
                    ->counts('roomLinks'),

                TextColumn::make('updated_at')
                    ->label('Last Updated')
                    ->dateTime('M j, Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('name', 'asc')
            ->filters([
                Tables\Filters\SelectFilter::make('parent_id')
                    ->relationship('parent', 'name')
                    ->label('Parent Room')
                    ->placeholder('All Rooms'),

                Tables\Filters\TernaryFilter::make('is_featured')
                    ->label('Featured Status')
                    ->placeholder('All Rooms')
                    ->trueLabel('Featured Only')
                    ->falseLabel('Non-featured Only'),

                Tables\Filters\SelectFilter::make('category')
                    ->label('By Category')
                    ->options(function () {
                        return Category::all()->pluck('name', 'id');
                    })
                    ->query(function ($query, $data) {
                        if (!empty($data['value'])) {
                            $query->whereHas('roomLinks', function ($q) use ($data) {
                                $q->where('category_id', $data['value']);
                            });
                        }
                    }),

                Tables\Filters\SelectFilter::make('location')
                    ->label('By Location')
                    ->options(function () {
                        return Location::all()->pluck('name', 'id');
                    })
                    ->query(function ($query, $data) {
                        if (!empty($data['value'])) {
                            $query->whereHas('roomLinks', function ($q) use ($data) {
                                $q->where('location_id', $data['value']);
                            });
                        }
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateHeading('No Rooms Found')
            ->emptyStateDescription('Create your first room by clicking the button below.')
            ->emptyStateIcon('heroicon-o-home');
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\RoomLinksRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRooms::route('/'),
            'create' => Pages\CreateRoom::route('/create'),
            'edit' => Pages\EditRoom::route('/{record}/edit'),
        ];
    }
}
