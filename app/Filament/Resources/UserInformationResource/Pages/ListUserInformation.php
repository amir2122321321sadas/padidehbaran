<?php

namespace App\Filament\Resources\UserInformationResource\Pages;

use App\Filament\Resources\UserInformationResource;
use App\Filament\Resources\UserResource\Widgets\UsersCountWidget;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListUserInformation extends ListRecords
{
    protected static string $resource = UserInformationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
          UsersCountWidget::make()
        ];
    }

}
