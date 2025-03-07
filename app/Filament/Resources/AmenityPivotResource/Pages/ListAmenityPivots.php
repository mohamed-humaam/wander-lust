<?php

namespace App\Filament\Resources\AmenityPivotResource\Pages;

use App\Filament\Resources\AmenityPivotResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAmenityPivots extends ListRecords
{
    protected static string $resource = AmenityPivotResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
