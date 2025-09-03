<?php

namespace App\Filament\Resources\UserViewResource\Pages;

use App\Filament\Resources\UserViewResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUserView extends EditRecord
{
    protected static string $resource = UserViewResource::class;

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
