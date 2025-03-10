<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ActivityPivotResource\Pages;

//use App\Filament\Resources\ActivityPivotResource\RelationManagers;
use App\Models\ActivityPivot;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

//use Illuminate\Database\Eloquent\Builder;
//use Illuminate\Database\Eloquent\SoftDeletingScope;

class ActivityPivotResource extends Resource
{
    // comment out this to view the resource
    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $model = ActivityPivot::class;

    protected static ?string $navigationIcon = 'heroicon-o-link';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Select::make('activity_id')
                    ->relationship('activity', 'name')
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
                TextColumn::make('activity.name')
                    ->label('Activity'),
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
            'index' => Pages\ListActivityPivots::route('/'),
            'create' => Pages\CreateActivityPivot::route('/create'),
            'edit' => Pages\EditActivityPivot::route('/{record}/edit'),
        ];
    }
}
