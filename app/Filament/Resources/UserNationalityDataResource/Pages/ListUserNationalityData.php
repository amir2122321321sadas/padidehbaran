<?php

namespace App\Filament\Resources\UserNationalityDataResource\Pages;

use App\Filament\Resources\UserNationalityDataResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListUserNationalityData extends ListRecords
{
    protected static string $resource = UserNationalityDataResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            \App\Filament\Resources\UserNationalityDataResource\Widgets\UserNationalityDataStatsWidget::class,
        ];
    }

    protected function getFooterWidgets(): array
    {
        return [
            \App\Filament\Resources\UserNationalityDataResource\Widgets\UsersWithoutNationalityDataTable::class,
        ];
    }
}
