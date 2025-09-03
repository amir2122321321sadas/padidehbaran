<?php

namespace App\Filament\Resources\UserNationalityDataResource\Widgets;

use App\Models\User;
use Filament\Widgets\TableWidget;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;

class UsersWithoutNationalityDataTable extends TableWidget
{
    protected static ?string $heading = 'کاربران بدون اطلاعات هویتی';


    protected function getTableQuery(): Builder|Relation|null
    {
        return User::query()
            ->whereDoesntHave('userNationalityData')
            ->limit(10);
    }

    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('email')->label('ایمیل کاربر')->searchable(),
        ];
    }
}