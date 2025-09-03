<?php

namespace App\Filament\Widgets;

use App\Models\Ticket;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Illuminate\Database\Eloquent\Builder;

class LatestTicketsWidget extends BaseWidget
{
    protected static ?int $sort = 2;
    protected int|string|array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Ticket::query()
                    ->latest()
                    ->limit(10)
            )
            ->columns([
                TextColumn::make('id')
                    ->label('شناسه')
                    ->sortable(),

                TextColumn::make('title')
                    ->label('عنوان')
                    ->searchable()
                    ->limit(50),

                TextColumn::make('user.userInformation.first_name')
                    ->label('نام کاربر')
                    ->formatStateUsing(function ($record) {
                        $firstName = $record->user->userInformation->first_name ?? '';
                        $lastName = $record->user->userInformation->last_name ?? '';
                        return trim($firstName . ' ' . $lastName);
                    })
                    ->searchable(),

                BadgeColumn::make('priority')
                    ->label('اولویت')
                    ->colors([
                        'success' => 'low',
                        'warning' => 'medium',
                        'danger' => 'high',
                        'danger' => 'urgent',
                    ])
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'low' => 'کم',
                        'medium' => 'متوسط',
                        'high' => 'زیاد',
                        'urgent' => 'فوری',
                        default => $state,
                    }),

                BadgeColumn::make('status')
                    ->label('وضعیت')
                    ->colors([
                        'success' => 'open',
                        'warning' => 'pending',
                        'success' => 'hasAnswer',
                        'danger' => 'closed',
                    ])
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'open' => 'باز',
                        'pending' => 'در حال بررسی',
                        'hasAnswer' => 'حل شده',
                        'closed' => 'بسته',
                        default => $state,
                    }),

                TextColumn::make('created_at')
                    ->label('تاریخ ایجاد')
                    ->dateTime('Y-m-d H:i')
                    ->sortable(),
            ])
            ->actions([
                Tables\Actions\Action::make('view')
                    ->label('مشاهده')
                    ->icon('heroicon-o-eye')
                    ->url(fn (Ticket $record): string =>
                        \App\Filament\Resources\TicketResource::getUrl('view', ['record' => $record])
                    ),
            ])
            ->paginated(false);
    }
}
