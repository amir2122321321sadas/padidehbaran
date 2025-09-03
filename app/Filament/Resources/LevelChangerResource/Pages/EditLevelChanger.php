<?php

namespace App\Filament\Resources\LevelChangerResource\Pages;

use App\Filament\Resources\LevelChangerResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLevelChanger extends EditRecord
{
    protected static string $resource = LevelChangerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
