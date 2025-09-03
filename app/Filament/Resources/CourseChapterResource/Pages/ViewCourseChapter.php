<?php

namespace App\Filament\Resources\CourseChapterResource\Pages;

use App\Filament\Resources\CourseChapterResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewCourseChapter extends ViewRecord
{
    protected static string $resource = CourseChapterResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
