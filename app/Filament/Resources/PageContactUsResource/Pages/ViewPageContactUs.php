<?php

namespace App\Filament\Resources\PageContactUsResource\Pages;

use App\Filament\Resources\PageContactUsResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewPageContactUs extends ViewRecord
{
    protected static string $resource = PageContactUsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
