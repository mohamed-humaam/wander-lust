<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AmenityResource\Pages;
use App\Models\Amenity;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Illuminate\Support\Str;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class AmenityResource extends Resource
{
    protected static ?string $model = Amenity::class;

    protected static ?string $navigationIcon = 'heroicon-o-sparkles';

    protected static ?string $navigationLabel = 'Property Amenities';

    protected static ?string $navigationGroup = 'Property Management';

    protected static ?int $navigationSort = 2;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Section::make('Basic Information')
                    ->description('Define the amenity details')
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('e.g., Swimming Pool, Free WiFi')
                            ->helperText('Enter a distinctive name that travelers will recognize')
                            ->autofocus()
                            ->live(onBlur: true)
                            ->afterStateUpdated(function (Set $set, ?string $state) {
                                if (!$state) {
                                    return;
                                }

                                $set('slug', Str::slug($state));
                            }),

                        TextInput::make('slug')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('e.g., swimming-pool, free-wifi')
                            ->helperText('Used in URLs and API requests (auto-generated from name)')
                            ->unique(ignoreRecord: true),
                    ]),

                Section::make('Visual Elements')
                    ->description('Upload an icon representing this amenity')
                    ->schema([
                        FileUpload::make('icon')
                            ->image()
                            ->directory('/icons')
                            ->helperText('Upload a simple, recognizable icon (recommended size: 64×64px)')
                            ->imageCropAspectRatio('1:1')
                            ->imageResizeTargetWidth('64')
                            ->imageResizeTargetHeight('64')
//                            ->panelAspectRatio('1:1')
                            ->panelLayout('compact')
                            ->maxSize(2048),
                    ]),

                Section::make('Description')
                    ->description('Explain what this amenity provides to guests')
                    ->collapsible()
                    ->schema([
                        RichEditor::make('description')
                            ->placeholder('Describe the amenity and its value to travelers...')
                            ->helperText('Keep descriptions concise but informative')
                            ->fileAttachmentsDisk('public')
                            ->fileAttachmentsDirectory('amenity-descriptions')
                            ->toolbarButtons([
                                'bold',
                                'bulletList',
                                'italic',
                                'link',
                                'orderedList',
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('icon')
                    ->size(40)
                    ->circular()
                    ->label('Icon'),

                TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->weight('medium')
                    ->copyable(),

                TextColumn::make('slug')
                    ->searchable()
                    ->sortable()
                    ->color('gray')
                    ->toggleable(isToggledHiddenByDefault: false),

                TextColumn::make('updated_at')
                    ->label('Last Updated')
                    ->dateTime('M j, Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('name', 'asc')
            ->filters([
                //
            ])
            ->actions([
//                Tables\Actions\ViewAction::make()
//                    ->modalHeading('Amenity Details'),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ])
            ->emptyStateHeading('No Amenities Found')
            ->emptyStateDescription('Create your first amenity by clicking the button below.')
            ->emptyStateIcon('heroicon-o-sparkles');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAmenities::route('/'),
            'create' => Pages\CreateAmenity::route('/create'),
            'edit' => Pages\EditAmenity::route('/{record}/edit'),
        ];
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['name', 'slug', 'description'];
    }
}
