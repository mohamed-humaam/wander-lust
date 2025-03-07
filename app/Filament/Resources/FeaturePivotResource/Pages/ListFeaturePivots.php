<?php

namespace App\Filament\Resources\FeaturePivotResource\Pages;

use App\Filament\Resources\FeaturePivotResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFeaturePivots extends ListRecords
{
    protected static string $resource = FeaturePivotResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
