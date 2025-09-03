<?php

namespace App\Filament\Resources\UserViewResource\Pages;

use App\Filament\Resources\UserViewResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateUserView extends CreateRecord
{
    protected static string $resource = UserViewResource::class;
}
