<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RoomResource\Pages;
//use App\Filament\Resources\RoomResource\RelationManagers;
use App\Models\Room;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
//use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
//use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
//use Illuminate\Database\Eloquent\Builder;
//use Illuminate\Database\Eloquent\SoftDeletingScope;

class RoomResource extends Resource
{
    protected static ?string $model = Room::class;

    protected static ?string $navigationIcon = 'heroicon-o-key';

    protected static ?int $navigationSort = 3;
    protected static ?string $navigationLabel = 'Accommodations';

    protected static ?string $navigationGroup = 'Variables';
    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Section::make('Basic Information')
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

                Section::make('Visual Elements')
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

                Section::make('Details & Features')
                    ->description('Provide comprehensive information about this accommodation')
                    ->schema([

                        RichEditor::make('description')
                            ->required()
                            ->placeholder('Describe the accommodation, including its unique features, views, amenities, and decor...')
                            ->helperText('Detailed description with formatting')
                            ->fileAttachmentsDisk('public')
                            ->fileAttachmentsDirectory('rooms/attachments')
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

                TextColumn::make('price')
                    ->label('Price Per Night')
                    ->money('usd')
                    ->sortable()
                    ->toggleable(),

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
            ])
            ->actions([
//                Tables\Actions\ViewAction::make(),
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
            ->emptyStateIcon('heroicon-o-key');
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
