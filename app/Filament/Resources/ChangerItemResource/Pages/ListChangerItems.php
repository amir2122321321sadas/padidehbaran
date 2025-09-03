<?php

namespace App\Filament\Resources\ChangerItemResource\Pages;

use App\Filament\Resources\ChangerItemResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListChangerItems extends ListRecords
{
    protected static string $resource = ChangerItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
