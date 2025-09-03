<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource\Widgets\UsersCountWidget;
use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            UsersCountWidget::make(),
        ];
    }

    protected function getFooterWidgets(): array
    {
        return [
          UserResource\Widgets\UserRegistersChart::make()
        ];
    }
}
