<?php

namespace App\Filament\Resources\CheckerExcelResource\Pages;

use App\Filament\Resources\CheckerExcelResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCheckerExcels extends ListRecords
{
    protected static string $resource = CheckerExcelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
