<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FeatureResource\Pages;
use App\Models\Feature;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class FeatureResource extends Resource
{
    protected static ?string $model = Feature::class;

    protected static ?string $navigationIcon = 'heroicon-o-star';

    protected static ?string $navigationLabel = 'Property Features';

    protected static ?string $navigationParentItem = 'Travel Packages';

    protected static ?int $navigationSort = 6;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Section::make('Basic Information')
                    ->description('Define the property feature details')
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('e.g., Ocean View, Private Garden')
                            ->helperText('Enter a descriptive name for this feature')
                            ->autofocus(),

                        Select::make('parent_id')
                            ->relationship('parent', 'name')
                            ->nullable()
                            ->placeholder('Select a parent feature (optional)')
                            ->searchable()
                            ->preload()
                            ->helperText('Group this under a parent feature if applicable')
                            ->createOptionForm([
                                TextInput::make('name')
                                    ->required()
                                    ->maxLength(255),
                            ]),
                    ]),

                Section::make('Visual Elements')
                    ->description('Upload an icon representing this feature')
                    ->schema([
                        FileUpload::make('icon')
                            ->image()
                            ->directory('icons')
                            ->helperText('Upload a square icon (recommended size: 128×128px)')
                            ->imageCropAspectRatio('1:1')
                            ->imageResizeTargetWidth('128')
                            ->imageResizeTargetHeight('128')
//                            ->panelAspectRatio('1:1')
                            ->panelLayout('compact')
                            ->maxSize(2048),
                    ]),

                Section::make('Description')
                    ->description('Explain what this feature provides to guests')
                    ->collapsible()
                    ->schema([
                        RichEditor::make('description')
                            ->placeholder('Describe what makes this feature valuable to travelers...')
                            ->helperText('Highlight how this feature enhances the guest experience')
                            ->fileAttachmentsDisk('public')
                            ->fileAttachmentsDirectory('storage/feature-descriptions')
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
                    ->circular()
                    ->size(40),

                TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->weight('medium')
                    ->description(fn (Feature $record): ?string =>
                    $record->description ? strip_tags(substr($record->description, 0, 60)) . '...' : null),

                TextColumn::make('parent.name')
                    ->label('Parent Feature')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color('primary'),

                TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime('M j, Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

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
                    ->label('Parent Feature')
                    ->placeholder('All Features')
                    ->searchable(),
            ])
            ->actions([
//                Tables\Actions\ViewAction::make()
//                    ->modalHeading('Feature Details'),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ])
            ->emptyStateHeading('No Features Found')
            ->emptyStateDescription('Create your first property feature by clicking the button below.')
            ->emptyStateIcon('heroicon-o-star');
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
            'index' => Pages\ListFeatures::route('/'),
            'create' => Pages\CreateFeature::route('/create'),
            'edit' => Pages\EditFeature::route('/{record}/edit'),
        ];
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['name', 'description'];
    }
}
