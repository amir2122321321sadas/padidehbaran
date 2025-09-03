<?php

namespace App\Filament\Resources\PageContactUsResource\Pages;

use App\Filament\Resources\PageContactUsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPageContactUs extends EditRecord
{
    protected static string $resource = PageContactUsResource::class;

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
