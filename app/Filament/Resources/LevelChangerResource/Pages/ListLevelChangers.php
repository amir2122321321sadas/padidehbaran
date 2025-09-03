<?php

namespace App\Filament\Resources\LevelChangerResource\Pages;

use App\Filament\Resources\LevelChangerResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLevelChangers extends ListRecords
{
    protected static string $resource = LevelChangerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
