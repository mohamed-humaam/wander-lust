<?php

namespace App\Filament\Resources\CategoryResource\Pages;

use App\Filament\Resources\TravelCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTravelCategories extends ListRecords
{
    protected static string $resource = TravelCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
