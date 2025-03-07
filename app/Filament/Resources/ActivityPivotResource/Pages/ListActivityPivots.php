<?php

namespace App\Filament\Resources\ActivityPivotResource\Pages;

use App\Filament\Resources\ActivityPivotResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListActivityPivots extends ListRecords
{
    protected static string $resource = ActivityPivotResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
