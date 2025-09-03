<?php

namespace App\Filament\Resources\CourseChapterFileResource\Pages;

use App\Filament\Resources\CourseChapterFileResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewCourseChapterFile extends ViewRecord
{
    protected static string $resource = CourseChapterFileResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
