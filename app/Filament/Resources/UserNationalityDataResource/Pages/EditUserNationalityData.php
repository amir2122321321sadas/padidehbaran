<?php

namespace App\Filament\Resources\UserNationalityDataResource\Pages;

use App\Filament\Resources\UserNationalityDataResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUserNationalityData extends EditRecord
{
    protected static string $resource = UserNationalityDataResource::class;

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
