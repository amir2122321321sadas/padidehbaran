<?php

namespace App\Filament\Resources\TicketResource\Pages;

use App\Filament\Resources\TicketResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use App\Models\User;

class ViewTicket extends ViewRecord
{
    protected static string $resource = TicketResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make()
                ->label('ویرایش'),

            Action::make('reply')
                ->label('پاسخ به تیکت')
                ->icon('heroicon-o-chat-bubble-left')
                ->form([
                    Section::make('پاسخ جدید')
                        ->schema([
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
                ])
                ->action(function (array $data): void {
                    $ticket = $this->record;

                    // ایجاد پیام جدید
                    $message = $ticket->messages()->create([
                        'user_id' => auth()->id(),
                        'message' => $data['message'],
                    ]);

                    // آپلود فایل‌های پیوست برای پیام (نه تیکت)
                    if (isset($data['attachments'])) {
                        foreach ($data['attachments'] as $attachment) {
                            $message->addMedia(storage_path('app/public/' . $attachment))
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
                ->action(function (array $data): void {
                    $this->record->update(['status' => $data['status']]);

                    Notification::make()
                        ->title('وضعیت تیکت با موفقیت تغییر کرد')
                        ->success()
                        ->send();
                })
                ->requiresConfirmation()
                ->modalHeading('تغییر وضعیت تیکت')
                ->modalDescription('وضعیت جدید را انتخاب کنید')
                ->modalSubmitActionLabel('تغییر وضعیت'),


        ];
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('اطلاعات تیکت')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('title')
                                    ->label('عنوان')
                                    ->disabled(),

                                TextInput::make('user.userInformation.first_name')
                                    ->label('نام کاربر')
                                    ->formatStateUsing(function ($record) {
                                        $firstName = $record->user->userInformation->first_name ?? '';
                                        $lastName = $record->user->userInformation->last_name ?? '';
                                        return trim($firstName . ' ' . $lastName);
                                    })
                                    ->disabled(),
                            ]),

                        Textarea::make('message')
                            ->label('پیام اصلی')
                            ->disabled()
                            ->rows(4),

                        // نمایش فایل‌های پیوست تیکت (نه پیام‌ها)
                        \Filament\Forms\Components\Placeholder::make('ticket_attachments')
                            ->label('فایل‌های پیوست تیکت')
                            ->content(function ($record) {
                                $attachments = $record->getMedia('attachments');
                                if ($attachments->count() === 0) {
                                    return '<span class="text-gray-500 dark:text-gray-400">فایلی پیوست نشده است</span>';
                                }
                                $html = '<div style="display: flex; flex-wrap: wrap; gap: 0.5rem;">';
                                foreach ($attachments as $media) {
                                    $fileName = $media->name;
                                    $fileUrl = $media->getUrl();
                                    $fileType = $media->mime_type;
                                    if (str_starts_with($fileType, 'image/')) {
                                        $html .= "
                                            <div style='display: inline-block;'>
                                                <a href='{$fileUrl}' target='_blank' style='display: block;'>
                                                    <img src='{$fileUrl}' alt='{$fileName}' style='width: 4rem; height: 4rem; object-fit: cover; border-radius: 0.375rem; border: 1px solid #d1d5db;' />
                                                </a>
                                                <div style='font-size: 0.75rem; text-align: center; color: #4b5563; margin-top: 0.25rem; width: 4rem; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;'>{$fileName}</div>
                                            </div>
                                        ";
                                    } else {
                                        $html .= "
                                            <div style='display: inline-block;'>
                                                <a href='{$fileUrl}' target='_blank' style='display: block; padding: 0.5rem; background-color: #f3f4f6; border-radius: 0.375rem; border: 1px solid #d1d5db;'>
                                                    <div style='width: 3rem; height: 3rem; display: flex; align-items: center; justify-content: center;'>
                                                        <svg style='width: 2rem; height: 2rem; color: #6b7280;' fill='none' stroke='currentColor' viewBox='0 0 24 24'>
                                                            <path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z'></path>
                                                        </svg>
                                                    </div>
                                                </a>
                                                <div style='font-size: 0.75rem; text-align: center; color: #4b5563; margin-top: 0.25rem; width: 4rem; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;'>{$fileName}</div>
                                            </div>
                                        ";
                                    }
                                }
                                $html .= '</div>';
                                return new \Illuminate\Support\HtmlString($html);
                            }),

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
                                ->required()
                                ->disabled(),

                                    Select::make('status')
                                    ->label('وضعیت جدید')
                                    ->options([
                                        'open' => 'باز',
                                        'pending' => 'در حال بررسی',
                                        'hasAnswer' => 'حل شده',
                                        'closed' => 'بسته',
                                    ])
                                    ->required(),


                            ]),
                    ])
                    ->collapsible(false),

                Section::make('تاریخ‌ها')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('created_at')
                                    ->label('تاریخ ایجاد')
                                    ->disabled(),

                                TextInput::make('updated_at')
                                    ->label('آخرین بروزرسانی')
                                    ->disabled(),
                            ]),
                    ])
                    ->collapsible()
                    ->collapsed(),

                Section::make('تمام پیام‌های تیکت')
                    ->schema([
                        \Filament\Forms\Components\Placeholder::make('messages')
                            ->label('')
                            ->content(function ($record) {
                                $messages = $record->messages()->with('user.userInformation')->orderBy('created_at')->get();
                                $html = '';
                                $currentUserId = auth()->id();

                                foreach ($messages as $message) {
                                    $firstName = $message->user->userInformation->first_name ?? '';
                                    $lastName = $message->user->userInformation->last_name ?? '';
                                    $userName = trim($firstName . ' ' . $lastName) ?: 'کاربر بدون نام';
                                    $time = $message->created_at->format('Y-m-d H:i');
                                    $isCurrentUser = $message->user_id == $currentUserId;

                                    // نمایش فایل‌های پیوست مخصوص هر پیام
                                    $attachmentsHtml = '';
                                    if ($message->getMedia('attachments')->count() > 0) {
                                        $attachmentsHtml .= '<div style="margin-top: 0.75rem; padding-top: 0.75rem; border-top: 1px solid #e5e7eb;">';
                                        $attachmentsHtml .= '<div style="font-size: 0.75rem; color: #6b7280; margin-bottom: 0.5rem;">فایل‌های پیوست پیام:</div>';
                                        $attachmentsHtml .= '<div style="display: flex; flex-wrap: wrap; gap: 0.5rem;">';

                                        foreach ($message->getMedia('attachments') as $media) {
                                            $fileName = $media->name;
                                            $fileUrl = $media->getUrl();
                                            $fileType = $media->mime_type;

                                            if (str_starts_with($fileType, 'image/')) {
                                                // نمایش تصاویر به صورت کوچک
                                                $attachmentsHtml .= "
                                                <div style='display: inline-block;'>
                                                    <a href='{$fileUrl}' target='_blank' style='display: block;'>
                                                        <img src='{$fileUrl}' alt='{$fileName}' style='width: 4rem; height: 4rem; object-fit: cover; border-radius: 0.375rem; border: 1px solid #d1d5db;' />
                                                    </a>
                                                    <div style='font-size: 0.75rem; text-align: center; color: #4b5563; margin-top: 0.25rem; width: 4rem; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;'>{$fileName}</div>
                                                </div>";
                                            } else {
                                                // نمایش سایر فایل‌ها به صورت آیکون
                                                $attachmentsHtml .= "
                                                <div style='display: inline-block;'>
                                                    <a href='{$fileUrl}' target='_blank' style='display: block; padding: 0.5rem; background-color: #f3f4f6; border-radius: 0.375rem; border: 1px solid #d1d5db;'>
                                                        <div style='width: 3rem; height: 3rem; display: flex; align-items: center; justify-content: center;'>
                                                            <svg style='width: 2rem; height: 2rem; color: #6b7280;' fill='none' stroke='currentColor' viewBox='0 0 24 24'>
                                                                <path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z'></path>
                                                            </svg>
                                                        </div>
                                                    </a>
                                                    <div style='font-size: 0.75rem; text-align: center; color: #4b5563; margin-top: 0.25rem; width: 4rem; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;'>{$fileName}</div>
                                                </div>";
                                            }
                                        }

                                        $attachmentsHtml .= '</div></div>';
                                    }

                                    if ($isCurrentUser) {
                                        // پیام‌های ادمین - رنگ آبی متمایز
                                        $html .= "
                                        <div style='padding: 1rem; margin-bottom: 1rem; border-left: 4px solid #3b82f6; background-color: #eff6ff; border-radius: 0.5rem 0 0 0.5rem;'>
                                            <div style='display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem;'>
                                                <span style='font-weight: 600; font-size: 0.875rem; color: #1d4ed8;'>{$userName} (شما)</span>
                                                <span style='font-size: 0.75rem; color: #3b82f6;'>{$time}</span>
                                            </div>
                                            <div style='font-size: 0.875rem; color: #1e40af;'>{$message->message}</div>
                                            {$attachmentsHtml}
                                        </div>";
                                    } else {
                                        // پیام‌های کاربر - رنگ سبز متمایز
                                        $html .= "
                                        <div style='padding: 1rem; margin-bottom: 1rem; border-right: 4px solid #22c55e; background-color: #f0fdf4; border-radius: 0 0.5rem 0.5rem 0;'>
                                            <div style='display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem;'>
                                                <span style='font-weight: 600; font-size: 0.875rem; color: #15803d;'>{$userName}</span>
                                                <span style='font-size: 0.75rem; color: #22c55e;'>{$time}</span>
                                            </div>
                                            <div style='font-size: 0.875rem; color: #166534;'>{$message->message}</div>
                                            {$attachmentsHtml}
                                        </div>";
                                    }
                                }

                                return new \Illuminate\Support\HtmlString($html ?: '<p class="text-gray-500 dark:text-gray-400">هیچ پیامی یافت نشد</p>');
                            })
                    ])
                    ->collapsible(false),
            ]);
    }
}
