<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TravelCategoryResource\Pages;
use App\Models\Category;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Illuminate\Support\Str;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TravelCategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static ?string $navigationIcon = 'heroicon-o-tag';

    protected static ?string $navigationLabel = 'Travel Categories';

    protected static ?string $navigationGroup = 'Variables';

    protected static ?int $navigationSort = 1;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Section::make('Basic Information')
                    ->description('Enter the essential category details')
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('e.g., Beach Destinations, Mountain Retreats')
                            ->helperText('Enter a descriptive name for this category')
                            ->autofocus()
                            ->live(onBlur: true)
                            ->afterStateUpdated(function (Set $set, ?string $state) {
                                if (! $state) {
                                    return;
                                }

                                $set('slug', Str::slug($state));
                            }),

                        TextInput::make('slug')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('e.g., beach-destinations, mountain-retreats')
                            ->helperText('Used in URLs (auto-generated from name)')
                            ->unique(ignoreRecord: true),

                        Select::make('parent_id')
                            ->relationship('parent', 'name')
                            ->nullable()
                            ->placeholder('Select a parent category (optional)')
                            ->searchable()
                            ->preload()
                            ->helperText('Nest this category under a parent category if needed')
                            ->createOptionForm([
                                TextInput::make('name')
                                    ->required()
                                    ->maxLength(255),
                                TextInput::make('slug')
                                    ->required()
                                    ->maxLength(255)
                                    ->unique(),
                            ]),
                    ]),

                Section::make('Media')
                    ->description('Upload images that represent this category')
                    ->schema([
                        FileUpload::make('images')
                            ->image()
                            ->multiple()
                            ->reorderable()
                            ->disk('public')
                            ->directory('categories/images')
                            ->helperText('Upload high-quality images that showcase this category (recommended size: 1200×800px)')
                            ->imageResizeMode('cover')
                            ->panelAspectRatio('16:9')
                            ->panelLayout('grid')
                            ->maxSize(2048),
                    ]),

                Section::make('Description')
                    ->description('Provide details about this category')
                    ->collapsible()
                    ->schema([
                        RichEditor::make('description')
                            ->placeholder('Describe what makes this category special and what travelers can expect...')
                            ->helperText('Include key highlights that will help travelers understand this category')
                            ->fileAttachmentsDisk('public')
                            ->fileAttachmentsDirectory('storage/category-descriptions')
                            ->toolbarButtons([
                                'blockquote',
                                'bold',
                                'bulletList',
                                'h2',
                                'h3',
                                'italic',
                                'link',
                                'orderedList',
                                'redo',
                                'strike',
                                'undo',
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('images')
                    ->stacked()
                    ->limit(3)
                    ->circular(false)
                    ->height(40),

                TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->weight('medium')
                    ->description(fn (Category $record): ?string =>
                    Str::limit($record->description ? strip_tags($record->description) : null, 50)),

                TextColumn::make('slug')
                    ->searchable()
                    ->sortable()
                    ->color('gray')
                    ->toggleable(isToggledHiddenByDefault: false),

                TextColumn::make('parent.name')
                    ->label('Parent Category')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color('success'),

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
                    ->label('Parent Category')
                    ->placeholder('All Categories')
                    ->searchable(),
            ])
            ->actions([
//                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ])
            ->emptyStateHeading('No Categories Found')
            ->emptyStateDescription('Create your first category by clicking the button below.')
            ->emptyStateIcon('heroicon-o-tag');
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
            'index' => Pages\ListTravelCategories::route('/'),
            'create' => Pages\CreateTravelCategory::route('/create'),
            'edit' => Pages\EditTravelCategory::route('/{record}/edit'),
        ];
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['name', 'slug', 'description'];
    }
}
