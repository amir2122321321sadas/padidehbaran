<?php

namespace App\Filament\Resources\UserExamResource\Pages;

use App\Filament\Resources\UserExamResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUserExam extends EditRecord
{
    protected static string $resource = UserExamResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
