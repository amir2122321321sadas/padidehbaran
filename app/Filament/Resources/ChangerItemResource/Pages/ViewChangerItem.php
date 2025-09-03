<?php

namespace App\Filament\Resources\ChangerItemResource\Pages;

use App\Filament\Resources\ChangerItemResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewChangerItem extends ViewRecord
{
    protected static string $resource = ChangerItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
