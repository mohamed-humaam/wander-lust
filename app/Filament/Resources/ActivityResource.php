<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ActivityResource\Pages;
use App\Models\Activity;
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

class ActivityResource extends Resource
{
    protected static ?string $model = Activity::class;

    protected static ?string $navigationIcon = 'heroicon-o-fire';

    protected static ?string $navigationLabel = 'Travel Activities';

    protected static ?string $navigationGroup = 'Travel Management';

    protected static ?int $navigationSort = 3;

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Section::make('Basic Information')
                    ->description('Enter the main details about this activity')
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('e.g., Scuba Diving, City Tour')
                            ->helperText('Enter a unique, descriptive name for this activity')
                            ->autofocus(),

                        Select::make('parent_id')
                            ->relationship('parent', 'name')
                            ->nullable()
                            ->preload()
                            ->placeholder('Select a parent activity (optional)')
                            ->searchable()
                            ->helperText('Group this activity under a parent category if applicable'),
                    ]),

                Section::make('Visual Elements')
                    ->description('Upload visual elements for this activity')
                    ->schema([
                        FileUpload::make('icon')
                            ->image()
                            ->directory('/icons')
                            ->helperText('Upload a square icon (recommended size: 128×128px)')
                            ->imageCropAspectRatio('1:1')
                            ->imageResizeTargetWidth('128')
                            ->imageResizeTargetHeight('128')
//                            ->panelAspectRatio('1:1')
                            ->panelLayout('compact')
                            ->maxSize(2048),
                    ]),

                Section::make('Description & Details')
                    ->description('Provide detailed information about this activity')
                    ->collapsible()
                    ->schema([
                        RichEditor::make('description')
                            ->placeholder('Describe what travelers can expect from this activity...')
                            ->helperText('Include details like duration, what to bring, difficulty level, etc.')
                            ->fileAttachmentsDisk('public')
                            ->fileAttachmentsDirectory('activity-descriptions')
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
                                'underline',
                                'undo',
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
                    ->circular(),
                TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->weight('medium')
                    ->copyable()
                    ->description(fn(Activity $record): ?string => $record->parent ? "Parent: {$record->parent->name}" : null),
                TextColumn::make('parent.name')
                    ->label('Category')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('updated_at')
                    ->label('Last Updated')
                    ->dateTime('M j, Y')
                    ->sortable(),
            ])
            ->defaultSort('name', 'asc')
            ->filters([
                Tables\Filters\SelectFilter::make('parent_id')
                    ->relationship('parent', 'name')
                    ->label('Filter by Category')
                    ->placeholder('All Categories'),
            ])
            ->actions([
//                Tables\Actions\ViewAction::make()
//                    ->modalHeading('Activity Details'),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ])
            ->emptyStateHeading('No Activities Found')
            ->emptyStateDescription('Create your first activity by clicking the button below.')
            ->emptyStateIcon('heroicon-o-fire');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListActivities::route('/'),
            'create' => Pages\CreateActivity::route('/create'),
            'edit' => Pages\EditActivity::route('/{record}/edit'),
        ];
    }
}
