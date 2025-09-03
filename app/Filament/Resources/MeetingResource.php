<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MeetingResource\Pages;
use App\Filament\Resources\MeetingResource\RelationManagers;
use App\Models\Meeting;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MeetingResource extends Resource
{
    protected static ?string $model = Meeting::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';
    protected static ?string $navigationLabel = 'جلسات';
    protected static ?string $navigationGroup = 'مدیریت جلسات';
    protected static ?string $modelLabel = 'جلسه';
    protected static ?string $pluralModelLabel = 'جلسات';

    public static function canViewAny(): bool
    {
        return auth()->user()?->can('view meet');
    }

    public static function canCreate(): bool
    {
        return auth()->user()?->can('create meet');
    }

    public static function canEdit($record): bool
    {
        return auth()->user()?->can('edit meet');
    }

    public static function canDelete($record): bool
    {
        return auth()->user()?->can('delete meet');
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('اطلاعات جلسه')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('عنوان جلسه')
                            ->placeholder('عنوان جلسه را وارد کنید')
                            ->required()
                            ->maxLength(50),

                        Forms\Components\TextInput::make('link')
                            ->label('لینک جلسه')
                            ->placeholder('لینک جلسه را وارد کنید')
                            ->required()
                        ,

                        Forms\Components\Textarea::make('description')
                            ->label('توضیحات جلسه')
                            ->placeholder('توضیحات مربوط به جلسه را وارد کنید')
                            ->maxLength(100)
                            ->columnSpanFull(),

                        Forms\Components\Select::make('status')
                            ->label('وضعیت جلسه')
                            ->options([
                                0 => 'غیرفعال',
                                1 => 'فعال',
                                2 => 'برگزار شده',
                                3 => 'لغو شده',
                            ])
                            ->native(false)
                            ->required(),

                        Forms\Components\DateTimePicker::make('expired_at')
                            ->label('تاریخ انقضا'),


                        Forms\Components\DateTimePicker::make('started_at')
                            ->label('تاریخ و ساعت شروع')
                            ->required(),

                        Forms\Components\DateTimePicker::make('end_at')
                            ->label('تاریخ و ساعت پایان')
                            ->required(),

                        Forms\Components\Select::make('user_id')
                            ->label('کاربران شرکت‌کننده')
                            ->options(User::pluck('email', 'id')->toArray())
                            ->multiple()
                            ->searchable()
                            ->preload()
                            ->required()
                            ->helperText('چندین کاربر را می‌توانید انتخاب کنید')
                            ->columnSpanFull()
                            ->dehydrateStateUsing(fn ($state) => $state ? json_encode($state) : null)
                            ->formatStateUsing(fn ($state) => $state ? json_decode($state, true) : []),

                        Forms\Components\Toggle::make('is_urgent')
                            ->label('آیا جلسه فوری است؟')
                            ->inline(false)
                            ->required(),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('عنوان جلسه')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('user_id')
                    ->label('شرکت‌کنندگان')
                    ->formatStateUsing(function ($state) {
                        if (empty($state)) {
                            return '—';
                        }
                        if (is_string($state)) {
                            $state = json_decode($state, true);
                        }
                        if (is_array($state)) {
                            $names = \App\Models\User::whereIn('id', $state)
                                ->pluck('email')
                                ->implode('، ');
                            return $names ?: '—';
                        }
                        return '—';
                    })
                    ->sortable()
                    ->placeholder('—'),

                Tables\Columns\SelectColumn::make('status')
                    ->label('وضعیت جلسه')
                    ->options([
                            0 => 'غیرفعال',
                            1 => 'فعال',
                            2 => 'برگزار شده',
                            3 => 'لغو شده',
                        ])
                    ->disablePlaceholderSelection()
                    ->sortable(),

                Tables\Columns\TextColumn::make('expired_at')
                    ->label('تاریخ انقضا')
                    ->dateTime('Y/m/d H:i')
                    ->sortable(),

                Tables\Columns\ToggleColumn::make('is_urgent')
                    ->label('جلسه فوری')
                    ->sortable(),

                Tables\Columns\TextColumn::make('started_at')
                    ->label('تاریخ و ساعت شروع')
                    ->dateTime('Y/m/d H:i')
                    ->sortable(),

                Tables\Columns\TextColumn::make('end_at')
                    ->label('تاریخ و ساعت پایان')
                    ->dateTime('Y/m/d H:i')
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('تاریخ ایجاد')
                    ->dateTime('Y/m/d H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('تاریخ بروزرسانی')
                    ->dateTime('Y/m/d H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('deleted_at')
                    ->label('تاریخ حذف')
                    ->dateTime('Y/m/d H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                    Tables\Actions\ForceDeleteAction::make(),
                    Tables\Actions\RestoreAction::make(),
                ])->label('عملیات'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make()
                    ->label('ایجاد جلسه جدید'),
            ]);
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
            'index' => Pages\ListMeetings::route('/'),
            'create' => Pages\CreateMeeting::route('/create'),
            'view' => Pages\ViewMeeting::route('/{record}'),
            'edit' => Pages\EditMeeting::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
