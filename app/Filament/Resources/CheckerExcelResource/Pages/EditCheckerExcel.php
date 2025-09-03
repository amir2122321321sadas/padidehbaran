<?php

namespace App\Filament\Resources\CheckerExcelResource\Pages;

use App\Filament\Resources\CheckerExcelResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCheckerExcel extends EditRecord
{
    protected static string $resource = CheckerExcelResource::class;

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
