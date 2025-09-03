<?php

namespace App\Filament\Resources\UserInformationResource\Pages;

use App\Filament\Resources\UserInformationResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewUserInformation extends ViewRecord
{
    protected static string $resource = UserInformationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
