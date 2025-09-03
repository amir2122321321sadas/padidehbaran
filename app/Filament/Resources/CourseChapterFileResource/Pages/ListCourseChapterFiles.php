<?php

namespace App\Filament\Resources\CourseChapterFileResource\Pages;

use App\Filament\Resources\CourseChapterFileResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCourseChapterFiles extends ListRecords
{
    protected static string $resource = CourseChapterFileResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
