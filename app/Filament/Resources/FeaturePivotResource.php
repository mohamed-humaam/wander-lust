<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FeaturePivotResource\Pages;
//use App\Filament\Resources\FeaturePivotResource\RelationManagers;
use App\Models\FeaturePivot;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
//use Illuminate\Database\Eloquent\Builder;
//use Illuminate\Database\Eloquent\SoftDeletingScope;

class FeaturePivotResource extends Resource
{
    protected static ?string $model = FeaturePivot::class;

    protected static ?string $navigationIcon = 'heroicon-o-link';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Select::make('feature_id')
                    ->relationship('feature', 'name')
                    ->required(),
                Select::make('package_id')
                    ->relationship('package', 'name')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('feature.name')
                    ->label('Feature'),
                TextColumn::make('package.name')
                    ->label('Package'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFeaturePivots::route('/'),
            'create' => Pages\CreateFeaturePivot::route('/create'),
            'edit' => Pages\EditFeaturePivot::route('/{record}/edit'),
        ];
    }
}
