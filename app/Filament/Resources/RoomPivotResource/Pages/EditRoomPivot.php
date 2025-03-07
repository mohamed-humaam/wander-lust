<?php

namespace App\Filament\Resources\RoomPivotResource\Pages;

use App\Filament\Resources\RoomPivotResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRoomPivot extends EditRecord
{
    protected static string $resource = RoomPivotResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
