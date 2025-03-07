<?php

namespace App\Filament\Resources\RoomPivotResource\Pages;

use App\Filament\Resources\RoomPivotResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRoomPivots extends ListRecords
{
    protected static string $resource = RoomPivotResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
