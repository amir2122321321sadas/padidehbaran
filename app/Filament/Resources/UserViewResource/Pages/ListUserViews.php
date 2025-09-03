<?php

namespace App\Filament\Resources\UserViewResource\Pages;

use App\Filament\Resources\UserViewResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListUserViews extends ListRecords
{
    protected static string $resource = UserViewResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            \App\Filament\Resources\UserViewResource\Widgets\UserViewStatsWidget::class,
        ];
    }
}
