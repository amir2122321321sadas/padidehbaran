<?php

namespace App\Filament\Resources\CheckerExcelResource\Pages;

use App\Filament\Resources\CheckerExcelResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewCheckerExcel extends ViewRecord
{
    protected static string $resource = CheckerExcelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
