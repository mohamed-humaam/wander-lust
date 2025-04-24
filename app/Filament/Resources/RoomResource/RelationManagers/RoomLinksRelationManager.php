<?php

namespace App\Filament\Resources\RoomResource\RelationManagers;

use App\Models\Category;
use App\Models\Location;
use App\Models\Activity;
use App\Models\Amenity;
use App\Models\Feature;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class RoomLinksRelationManager extends RelationManager
{
    protected static string $relationship = 'roomLinks';

    protected static ?string $recordTitleAttribute = 'id';

    protected static ?string $title = 'Accommodation Links';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('category_id')
                    ->label('Category')
                    ->options(function () {
                        return Category::all()->pluck('name', 'id');
                    })
                    ->searchable()
                    ->preload()
                    ->required()
                    ->helperText('Select a category for this accommodation'),

                Forms\Components\Select::make('location_id')
                    ->label('Location')
                    ->options(function () {
                        return Location::all()->pluck('name', 'id');
                    })
                    ->searchable()
                    ->preload()
                    ->required()
                    ->helperText('Select a location for this accommodation'),

                Forms\Components\Select::make('amenity_id')
                    ->label('Amenity')
                    ->options(function () {
                        return Amenity::all()->pluck('name', 'id');
                    })
                    ->searchable()
                    ->preload()
                    ->nullable()
                    ->helperText('Select an optional amenity'),

                Forms\Components\Select::make('activity_id')
                    ->label('Activity')
                    ->options(function () {
                        return Activity::all()->pluck('name', 'id');
                    })
                    ->searchable()
                    ->preload()
                    ->nullable()
                    ->helperText('Select an optional activity'),

                Forms\Components\Select::make('feature_id')
                    ->label('Feature')
                    ->options(function () {
                        return Feature::all()->pluck('name', 'id');
                    })
                    ->searchable()
                    ->preload()
                    ->nullable()
                    ->helperText('Select an optional feature'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('category.name')
                    ->label('Category')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('location.name')
                    ->label('Location')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('amenity.name')
                    ->label('Amenity')
                    ->sortable()
                    ->searchable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('activity.name')
                    ->label('Activity')
                    ->sortable()
                    ->searchable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('feature.name')
                    ->label('Feature')
                    ->sortable()
                    ->searchable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime('M j, Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category_id')
                    ->label('Category')
                    ->multiple()
                    ->options(function () {
                        return Category::all()->pluck('name', 'id');
                    }),

                Tables\Filters\SelectFilter::make('location_id')
                    ->label('Location')
                    ->multiple()
                    ->options(function () {
                        return Location::all()->pluck('name', 'id');
                    }),

                Tables\Filters\SelectFilter::make('amenity_id')
                    ->label('Amenity')
                    ->multiple()
                    ->options(function () {
                        return Amenity::all()->pluck('name', 'id');
                    }),

                Tables\Filters\SelectFilter::make('activity_id')
                    ->label('Activity')
                    ->multiple()
                    ->options(function () {
                        return Activity::all()->pluck('name', 'id');
                    }),

                Tables\Filters\SelectFilter::make('feature_id')
                    ->label('Feature')
                    ->multiple()
                    ->options(function () {
                        return Feature::all()->pluck('name', 'id');
                    }),

                Tables\Filters\Filter::make('has_amenity')
                    ->label('Has Any Amenity')
                    ->query(fn (Builder $query): Builder => $query->whereNotNull('amenity_id')),

                Tables\Filters\Filter::make('has_activity')
                    ->label('Has Any Activity')
                    ->query(fn (Builder $query): Builder => $query->whereNotNull('activity_id')),

                Tables\Filters\Filter::make('has_feature')
                    ->label('Has Any Feature')
                    ->query(fn (Builder $query): Builder => $query->whereNotNull('feature_id')),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
