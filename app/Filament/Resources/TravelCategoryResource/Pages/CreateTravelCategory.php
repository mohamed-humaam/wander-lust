<?php

namespace App\Filament\Resources\CategoryResource\Pages;

use App\Filament\Resources\TravelCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTravelCategory extends CreateRecord
{
    protected static string $resource = TravelCategoryResource::class;
}
