<?php

namespace App\Filament\Resources\UserExamResource\Pages;

use App\Filament\Resources\UserExamResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListUserExams extends ListRecords
{
    protected static string $resource = UserExamResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
