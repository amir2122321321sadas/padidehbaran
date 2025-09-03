<?php

namespace App\Filament\Resources\UserViewResource\Pages;

use App\Filament\Resources\UserViewResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewUserView extends ViewRecord
{
    protected static string $resource = UserViewResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
