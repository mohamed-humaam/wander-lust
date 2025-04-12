<?php

namespace App\Filament\Resources\CategoryResource\Pages;

use App\Filament\Resources\TravelCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTravelCategory extends EditRecord
{
    protected static string $resource = TravelCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
