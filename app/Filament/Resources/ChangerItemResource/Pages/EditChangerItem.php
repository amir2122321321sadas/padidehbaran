<?php

namespace App\Filament\Resources\ChangerItemResource\Pages;

use App\Filament\Resources\ChangerItemResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditChangerItem extends EditRecord
{
    protected static string $resource = ChangerItemResource::class;

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
