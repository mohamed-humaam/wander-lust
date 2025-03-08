<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PackageResource\Pages;
//use App\Filament\Resources\PackageResource\RelationManagers;
use App\Models\Package;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
//use Illuminate\Database\Eloquent\Builder;
//use Illuminate\Database\Eloquent\SoftDeletingScope;

class PackageResource extends Resource
{
    protected static ?string $model = Package::class;

    protected static ?string $navigationIcon = 'heroicon-o-gift';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('slug')
                    ->required()
                    ->maxLength(255),
                FileUpload::make('images')
                    ->image()
                    ->multiple()
                    ->directory('packages/images'),
                FileUpload::make('gallery')
                    ->image()
                    ->multiple()
                    ->directory('packages/gallery'),
                Select::make('category_id')
                    ->relationship('category', 'name')
                    ->preload()
                    ->live()
                    ->required(),
                Select::make('location_id')
                    ->relationship('location', 'name')
                    ->preload()
                    ->live()
                    ->required(),
                RichEditor::make('description'),
                TextInput::make('price')
                    ->numeric()
                    ->required(),
                Select::make('amenities')
                    ->relationship('amenities', 'name')
                    ->preload()
                    ->live()
                    ->multiple(),
                Select::make('rooms')
                    ->relationship('rooms', 'name')
                    ->preload()
                    ->live()
                    ->multiple(),
                Select::make('activities')
                    ->relationship('activities', 'name')
                    ->preload()
                    ->live()
                    ->multiple(),
                Select::make('features')
                    ->relationship('features', 'name')
                    ->preload()
                    ->live()
                    ->multiple(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('slug')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('price')
                    ->money('usd')
                    ->sortable(),
                TextColumn::make('category.name')
                    ->label('Category'),
                TextColumn::make('location.name')
                    ->label('Location'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPackages::route('/'),
            'create' => Pages\CreatePackage::route('/create'),
            'edit' => Pages\EditPackage::route('/{record}/edit'),
        ];
    }
}
