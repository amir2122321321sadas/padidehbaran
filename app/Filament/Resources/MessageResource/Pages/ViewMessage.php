<?php

namespace App\Filament\Resources\MessageResource\Pages;

use App\Filament\Resources\MessageResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;

class ViewMessage extends ViewRecord
{
    protected static string $resource = MessageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make()
                ->label('ویرایش'),
        ];
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('اطلاعات پیام')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('ticket.title')
                                    ->label('تیکت')
                                    ->disabled(),
                                
                                TextInput::make('user.name')
                                    ->label('کاربر')
                                    ->disabled(),
                            ]),

                        Textarea::make('message')
                            ->label('پیام')
                            ->disabled()
                            ->rows(8),
                    ])
                    ->collapsible(false),

                Section::make('تاریخ‌ها')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('created_at')
                                    ->label('تاریخ ارسال')
                                    ->disabled(),
                                
                                TextInput::make('updated_at')
                                    ->label('آخرین بروزرسانی')
                                    ->disabled(),
                            ]),
                    ])
                    ->collapsible()
                    ->collapsed(),
            ]);
    }
}
