<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TicketResource\Pages;
use App\Models\Ticket;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Grid;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\ActionGroup;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class TicketResource extends Resource
{
    protected static ?string $model = Ticket::class;

    protected static ?string $navigationIcon = 'heroicon-o-ticket';

    protected static ?string $navigationLabel = 'تیکت‌ها';

    protected static ?string $modelLabel = 'تیکت';

    protected static ?string $pluralModelLabel = 'تیکت‌ها';

    protected static ?string $navigationGroup = 'تیکت‌ها';

    protected static ?int $navigationSort = 10;




    public static function canViewAny(): bool
    {
        return auth()->user()?->can('view ticket');
    }

    public static function canCreate(): bool
    {
        return auth()->user()?->can('create ticket');
    }

    public static function canEdit($record): bool
    {
        return auth()->user()?->can('edit ticket');
    }

    public static function canDelete($record): bool
    {
        return auth()->user()?->can('delete ticket');
    }



    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('اطلاعات تیکت')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('title')
                                    ->label('عنوان')
                                    ->required()
                                    ->maxLength(255),

                                Select::make('user_id')
                                    ->label('کاربر')
                                    ->options(User::pluck('name', 'id'))
                                    ->searchable()
                                    ->required(),
                            ]),

                        Textarea::make('message')
                            ->label('پیام')
                            ->required()
                            ->rows(4),

                        Grid::make(3)
                            ->schema([
                                Select::make('priority')
                                    ->label('اولویت')
                                    ->options([
                                        'low' => 'کم',
                                        'medium' => 'متوسط',
                                        'high' => 'زیاد',
                                        'urgent' => 'فوری',
                                    ])
                                    ->default('low')
                                    ->required(),

                                Select::make('status')
                                    ->label('وضعیت')
                                    ->options([
                                        'open' => 'باز',
                                        'pending' => 'در حال بررسی',
                                        'hasAnswer' => 'پاسخ داده شده',
                                        'closed' => 'بسته',
                                    ])
                                    ->default('open')
                                    ->required(),


                            ]),
                    ])
                    ->collapsible(),

                Section::make('فایل‌های پیوست')
                    ->schema([
                        FileUpload::make('attachments')
                            ->label('فایل‌های پیوست')
                            ->multiple()
                            ->disk('public')
                            ->directory('tickets')
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
                    ->searchable()
                    ->sortable(),

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
                        'warning' => 'in_progress',
                        'success' => 'resolved',
                        'danger' => 'closed',
                    ])
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                            'open' => 'باز',
                            'pending' => 'در حال بررسی',
                            'hasAnswer' => 'پاسخ داده شده',
                            'closed' => 'بسته',
                        default => $state,
                    }),



                TextColumn::make('created_at')
                    ->label('تاریخ ایجاد')
                    ->dateTime('Y-m-d H:i')
                    ->sortable(),

                TextColumn::make('messages_count')
                    ->label('تعداد پیام‌ها')
                    ->counts('messages')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('وضعیت')
                    ->options([
                        'open' => 'باز',
                        'pending' => 'در حال بررسی',
                        'hasAnswer' => 'پاسخ داده شده',
                        'closed' => 'بسته',
                    ]),

                Tables\Filters\SelectFilter::make('priority')
                    ->label('اولویت')
                    ->options([
                        'low' => 'کم',
                        'medium' => 'متوسط',
                        'high' => 'زیاد',
                        'urgent' => 'فوری',
                    ]),


            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->label('مشاهده')
                    ->icon('heroicon-o-eye'),

                Tables\Actions\EditAction::make()
                    ->label('ویرایش')
                    ->icon('heroicon-o-pencil-square'),

                Action::make('reply')
                    ->label('پاسخ')
                    ->icon('heroicon-o-chat-bubble-left')
                    ->form([
                        Textarea::make('message')
                            ->label('پیام پاسخ')
                            ->required()
                            ->rows(4),

                        FileUpload::make('attachments')
                            ->label('فایل‌های پیوست')
                            ->multiple()
                            ->disk('public')
                            ->directory('tickets')
                            ->acceptedFileTypes(['image/*', 'application/pdf', 'text/*'])
                            ->maxSize(10240),
                    ])
                    ->action(function (array $data, Ticket $ticket): void {
                        // ایجاد پیام جدید
                        $ticket->messages()->create([
                            'user_id' => auth()->id(),
                            'message' => $data['message'],
                        ]);

                        // آپلود فایل‌های پیوست
                        if (isset($data['attachments'])) {
                            foreach ($data['attachments'] as $attachment) {
                                // آپلود فایل به Media Library از مسیر کامل
                                $ticket->addMedia(storage_path('app/public/' . $attachment))
                                    ->toMediaCollection('attachments');
                            }
                        }

                        // تغییر وضعیت تیکت
                        if ($ticket->status === 'open') {
                            $ticket->update(['status' => 'in_progress']);
                        }

                        Notification::make()
                            ->title('پاسخ با موفقیت ارسال شد')
                            ->success()
                            ->send();
                    })
                    ->requiresConfirmation()
                    ->modalHeading('ارسال پاسخ به تیکت')
                    ->modalDescription('پیام پاسخ خود را وارد کنید')
                    ->modalSubmitActionLabel('ارسال پاسخ'),

                Action::make('change_status')
                    ->label('تغییر وضعیت')
                    ->icon('heroicon-o-arrow-path-rounded-square')
                    ->form([
                        Select::make('status')
                            ->label('وضعیت جدید')
                            ->options([
                                'open' => 'باز',
                                'pending' => 'در حال بررسی',
                                'hasAnswer' => 'پاسخ داده شده',
                                'closed' => 'بسته',
                            ])
                            ->required(),
                    ])
                    ->action(function (array $data, Ticket $ticket): void {
                        $ticket->update(['status' => $data['status']]);

                        Notification::make()
                            ->title('وضعیت تیکت با موفقیت تغییر کرد')
                            ->success()
                            ->send();
                    })
                    ->requiresConfirmation()
                    ->modalHeading('تغییر وضعیت تیکت')
                    ->modalDescription('وضعیت جدید را انتخاب کنید')
                    ->modalSubmitActionLabel('تغییر وضعیت'),
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
            'index' => Pages\ListTickets::route('/'),
            'create' => Pages\CreateTicket::route('/create'),
            'view' => Pages\ViewTicket::route('/{record}'),
            'edit' => Pages\EditTicket::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->with(['user', 'assignedTo', 'messages'])
            ->withCount('messages');
    }
}
