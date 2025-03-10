<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LocationResource\Pages;
//use App\Filament\Resources\LocationResource\RelationManagers;
use App\Models\Location;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
//use Illuminate\Database\Eloquent\Builder;
//use Illuminate\Database\Eloquent\SoftDeletingScope;

class LocationResource extends Resource
{
    protected static ?string $model = Location::class;

    protected static ?string $navigationIcon = 'heroicon-o-map-pin';
    protected static ?string $navigationLabel = 'Destinations';
    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Section::make('Basic Information')
                    ->description('Enter the essential details about this destination')
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('e.g., Bali, Santorini, New York City')
                            ->helperText('The display name of this destination'),

                        TextInput::make('slug')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('e.g., bali, santorini, new-york-city')
                            ->helperText('URL-friendly version of the name - use lowercase letters, numbers and hyphens')
                            ->unique(ignorable: fn ($record) => $record),
                    ])->columns(2),

                Section::make('Images')
                    ->description('Upload high-quality photos of this destination')
                    ->schema([
                        FileUpload::make('images')
                            ->image()
                            ->multiple()
                            ->reorderable()
                            ->directory('locations/images')
                            ->helperText('Upload main featured images (recommended size: 1920x1080px)')
                            ->maxFiles(5),

                        FileUpload::make('gallery')
                            ->image()
                            ->multiple()
                            ->reorderable()
                            ->directory('locations/gallery')
                            ->helperText('Upload additional gallery images to showcase the destination'),
                    ]),

                Section::make('Location Details')
                    ->description('Provide detailed information about this destination')
                    ->schema([
                        Textarea::make('location')
                            ->placeholder('e.g., Located on the southeastern coast of Greece in the Aegean Sea...')
                            ->helperText('Brief description of the physical location and surrounding area')
                            ->rows(3),

                        RichEditor::make('description')
                            ->placeholder('Describe what makes this destination special, including attractions, activities, and experiences...')
                            ->helperText('Detailed description of the destination with formatting')
                            ->fileAttachmentsDisk('public')
                            ->fileAttachmentsDirectory('locations/attachments'),

                        Textarea::make('google_location')
                            ->placeholder('<iframe src="https://www.google.com/maps/embed?pb=..." width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>')
                            ->helperText('Paste the embed code from Google Maps to show the exact location')
                            ->rows(3),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('images')
                    ->stacked()
                    ->limit(1)
                    ->circular()
                    ->label('Image'),

                TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                TextColumn::make('slug')
                    ->searchable()
                    ->sortable()
                    ->color('gray'),

                TextColumn::make('created_at')
                    ->dateTime('M j, Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->dateTime('M j, Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('name', 'asc')
            ->filters([
                //
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
            ->emptyStateHeading('No Locations Found')
            ->emptyStateDescription('Create your first location by clicking the button below.')
            ->emptyStateIcon('heroicon-o-map');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLocations::route('/'),
            'create' => Pages\CreateLocation::route('/create'),
            'edit' => Pages\EditLocation::route('/{record}/edit'),
        ];
    }
}
