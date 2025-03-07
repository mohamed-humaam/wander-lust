<?php

namespace App\Filament\Resources\FeaturePivotResource\Pages;

use App\Filament\Resources\FeaturePivotResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFeaturePivot extends EditRecord
{
    protected static string $resource = FeaturePivotResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
