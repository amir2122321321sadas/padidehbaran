<?php

namespace App\Filament\Resources\UserNationalityDataResource\Pages;

use App\Filament\Resources\UserNationalityDataResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewUserNationalityData extends ViewRecord
{
    protected static string $resource = UserNationalityDataResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
