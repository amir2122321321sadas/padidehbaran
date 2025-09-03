<?php

namespace App\Filament\Resources\LevelChangerResource\Pages;

use App\Filament\Resources\LevelChangerResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewLevelChanger extends ViewRecord
{
    protected static string $resource = LevelChangerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
