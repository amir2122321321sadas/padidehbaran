<?php

namespace App\Filament\Resources\CourseChapterFileResource\Pages;

use App\Filament\Resources\CourseChapterFileResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCourseChapterFile extends EditRecord
{
    protected static string $resource = CourseChapterFileResource::class;

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
