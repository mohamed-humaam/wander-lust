<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RoomPivotResource\Pages;

//use App\Filament\Resources\RoomPivotResource\RelationManagers;
use App\Models\RoomLink;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

//use Illuminate\Database\Eloquent\Builder;
//use Illuminate\Database\Eloquent\SoftDeletingScope;

class RoomPivotResource extends Resource
{
    // comment out this to view the resource
    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $model = RoomLink::class;

    protected static ?string $navigationIcon = 'heroicon-o-link';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Select::make('room_id')
                    ->relationship('room', 'name')
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
                TextColumn::make('room.name')
                    ->label('Room'),
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
            'index' => Pages\ListRoomPivots::route('/'),
            'create' => Pages\CreateRoomPivot::route('/create'),
            'edit' => Pages\EditRoomPivot::route('/{record}/edit'),
        ];
    }
}
