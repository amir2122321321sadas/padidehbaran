<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MessageResource\Pages;
use App\Models\Message;
use App\Models\User;
use App\Models\Ticket;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Grid;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Builder;

class MessageResource extends Resource
{
    protected static ?string $model = Message::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';

    protected static ?string $navigationLabel = 'پیام‌های تیکت';

    protected static ?string $modelLabel = 'پیام';

    protected static ?string $pluralModelLabel = 'پیام‌ها';

    protected static ?string $navigationGroup = 'تیکت‌ها';

    protected static ?int $navigationSort = 11;

    public static function canViewAny(): bool
    {
        return auth()->user()?->can('view message');
    }

    public static function canCreate(): bool
    {
        return auth()->user()?->can('create message');
    }

    public static function canEdit($record): bool
    {
        return auth()->user()?->can('edit message');
    }

    public static function canDelete($record): bool
    {
        return auth()->user()?->can('delete message');
    }



    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('اطلاعات پیام')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                Select::make('ticket_id')
                                    ->label('تیکت')
                                    ->options(Ticket::pluck('title', 'id'))
                                    ->searchable()
                                    ->required(),

                                Select::make('user_id')
                                    ->label('کاربر')
                                    ->options(function () {
                                        return User::with('userInformation')
                                            ->get()
                                            ->mapWithKeys(function ($user) {
                                                $firstName = $user->userInformation->first_name ?? '';
                                                $lastName = $user->userInformation->last_name ?? '';
                                                $fullName = trim($firstName . ' ' . $lastName);
                                                return [$user->id => $fullName ?: 'کاربر بدون نام'];
                                            });
                                    })
                                    ->searchable()
                                    ->required(),
                            ]),

                        Textarea::make('message')
                            ->label('پیام')
                            ->required()
                            ->rows(6),
                    ])
                    ->collapsible(),

                Section::make('فایل‌های پیوست')
                    ->schema([
                        FileUpload::make('attachments')
                            ->label('فایل‌های پیوست')
                            ->multiple()
                            ->disk('public')
                            ->directory('ticket-messages')
                            ->acceptedFileTypes(['image/*', 'application/pdf', 'text/*'])
                            ->maxSize(10240), // 10MB
                    ])
                    ->collapsible(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('شناسه')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('ticket.title')
                    ->label('تیکت')
                    ->searchable()
                    ->limit(50)
                    ->url(fn (Message $record): string =>
                        TicketResource::getUrl('view', ['record' => $record->ticket_id])
                    ),

                TextColumn::make('user.userInformation.first_name')
                    ->label('نام کاربر')
                    ->formatStateUsing(function ($record) {
                        $firstName = $record->user->userInformation->first_name ?? '';
                        $lastName = $record->user->userInformation->last_name ?? '';
                        return trim($firstName . ' ' . $lastName);
                    })
                    ->searchable()
                    ->sortable(),

                TextColumn::make('message')
                    ->label('پیام')
                    ->searchable()
                    ->limit(100)
                    ->html(),

                TextColumn::make('created_at')
                    ->label('تاریخ ارسال')
                    ->dateTime('Y-m-d H:i')
                    ->sortable(),

                TextColumn::make('ticket.status')
                    ->label('وضعیت تیکت')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'open' => 'success',
                        'pending' => 'warning',
                        'hasAnswer' => 'success',
                        'closed' => 'danger',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'open' => 'باز',
                        'pending' => 'در حال بررسی',
                        'hasAnswer' => 'حل شده',
                        'closed' => 'بسته',
                        default => $state,
                    }),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('ticket.status')
                    ->label('وضعیت تیکت')
                    ->options([
                        'open' => 'باز',
                        'pending' => 'در حال بررسی',
                        'hasAnswer' => 'حل شده',
                        'closed' => 'بسته',
                    ]),

                Tables\Filters\SelectFilter::make('user_id')
                    ->label('کاربر')
                    ->options(function () {
                        return User::with('userInformation')
                            ->get()
                            ->mapWithKeys(function ($user) {
                                $firstName = $user->userInformation->first_name ?? '';
                                $lastName = $user->userInformation->last_name ?? '';
                                $fullName = trim($firstName . ' ' . $lastName);
                                return [$user->id => $fullName ?: 'کاربر بدون نام'];
                            });
                    })
                    ->searchable(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->label('مشاهده')
                    ->icon('heroicon-o-eye'),

                Tables\Actions\EditAction::make()
                    ->label('ویرایش')
                    ->icon('heroicon-o-pencil-square'),

                Tables\Actions\DeleteAction::make()
                    ->label('حذف')
                    ->icon('heroicon-o-trash'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMessages::route('/'),
            'create' => Pages\CreateMessage::route('/create'),
            'view' => Pages\ViewMessage::route('/{record}'),
            'edit' => Pages\EditMessage::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->with(['ticket', 'user']);
    }
}
