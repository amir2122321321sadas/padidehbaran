<?php

namespace App\Filament\Resources;

use App\Filament\Exports\UserExporter;
use App\Filament\Imports\UserImporter;
use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Imports\UsersImport;
use App\Models\User;
use App\Models\UserInformation;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\ExportAction;
use Filament\Tables\Actions\ImportAction;
use Filament\Tables\Table;
use HayderHatem\FilamentExcelImport\Actions\FullImportAction;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationLabel = 'کاربران';

    protected static ?string $navigationGroup = 'مدیریت کاربران';

    protected static ?string $modelLabel = 'کاربر';
    protected static ?string $pluralModelLabel = 'کاربرها';
    protected static ?string $recordTitleAttribute = 'email';

    public static function getGloballySearchableAttributes(): array
    {
        return ['email' , 'identification_code'];
    }






    public static function canViewAny(): bool
    {
        return auth()->user()?->can('view user');
    }

    public static function canCreate(): bool
    {
        return auth()->user()?->can('create user');
    }

    public static function canEdit($record): bool
    {
        return auth()->user()?->can('edit user');
    }

    public static function canDelete($record): bool
    {
        return auth()->user()?->can('delete user');
    }



    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('اطلاعات کاربری')
                    ->schema([

                        Forms\Components\TextInput::make('email')
                            ->label('ایمیل')
                            ->helperText('آدرس ایمیل معتبر کاربر را وارد کنید')
                            ->email()
                            ->required(),
                        Forms\Components\DateTimePicker::make('email_verified_at')
                            ->label('تاریخ تایید ایمیل')
                            ->helperText('تاریخی که ایمیل کاربر تایید شده است (اختیاری)'),

                        Forms\Components\TextInput::make('identification_code')
                            ->label('کد معرف')
                            ->helperText('کد معرف کاربر را وارد کنید')
                            ->required()
                            ->columnSpanFull(),
                    ])->columns(2),
                Forms\Components\Section::make('تنظیمات کاربر')
                    ->schema([
                        Forms\Components\TextInput::make('theme')
                            ->label('قالب')
                            ->helperText('نام قالب انتخابی کاربر (اختیاری)'),
                        Forms\Components\ColorPicker::make('theme_color')
                            ->label('رنگ قالب')
                            ->helperText('رنگ قالب انتخابی کاربر (اختیاری)'),
                        Forms\Components\DateTimePicker::make('banned_at')
                            ->label('تاریخ مسدود شدن')
                            ->helperText('در صورت مسدود شدن کاربر، تاریخ آن را وارد کنید'),

                        Forms\Components\Select::make('is_active')
                            ->label('وضعیت پرداخت بیمه نامه')
                            ->helperText('وضعیت کاربر')
                            ->native(false)
                            ->options([
                                0  => 'کاربر بیمه نامه فعال ندارد ',
                                1 => 'کاربر فعال است',
                                2 => 'کاربر بیمه نامه پرداخت نشده دارد'
                            ])
                            ->required(),
                    ]),
                Forms\Components\Section::make('درآمدهای کاربر')
                    ->schema([
                        Forms\Components\Repeater::make('incomes')
                            ->label('درآمدها')
                            ->relationship('incomes')
                            ->createItemButtonLabel('افزودن درآمد جدید')
                            ->schema([
                                Forms\Components\TextInput::make('income')
                                    ->label('مقدار درآمد')
                                    ->numeric()
                                    ->required(),
                                Forms\Components\DateTimePicker::make('created_at')
                                    ->label('تاریخ')
                                    ->jalali()
                                    ->required(),
                            ])
                            ->columns(2)
                            ->defaultItems(0)
                            ->deletable(true)
                            ->collapsible()
                            ->itemLabel(fn ($state) => $state['income'] ?? 'درآمد جدید'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table

            ->columns([

                Tables\Columns\SelectColumn::make('is_active')
                    ->label('وضعیت کاربر')
                    ->disablePlaceholderSelection()
                    ->options([
                        0  => 'کاربر بیمه نامه فعال ندارد ',
                        1 => 'کاربر فعال است',
                        2 => 'کاربر بیمه نامه پرداخت نشده دارد'
                    ]),
                Tables\Columns\TextColumn::make('email')
                    ->label('ایمیل')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email_verified_at')
                    ->label('تاریخ تایید ایمیل')
                    ->placeholder('تایید نشده')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('theme')
                    ->label('قالب')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                Tables\Columns\ColorColumn::make('theme_color')
                    ->label('رنگ قالب')
                    ->placeholder('انتخاب نشده')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('banned_at')
                    ->label('تاریخ مسدود شدن')
                    ->dateTime()
                    ->placeholder('کاربر مسدود نشده')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('تاریخ ایجاد')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('تاریخ بروزرسانی')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->label('تاریخ حذف')
                    ->dateTime()
                    ->placeholder('حذف نشده')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

            ])

            ->filters([
                Tables\Filters\TrashedFilter::make(),
                Tables\Filters\Filter::make('banned')
                    ->label('کاربران مسدود شده')
                    ->query(fn ($query) => $query->whereNotNull('banned_at')),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                    Tables\Actions\ForceDeleteAction::make(),
                    Tables\Actions\RestoreAction::make(),
                ])->label('عملیات'),
            ])
            ->headerActions([
                ExportAction::make()
                    ->exporter(UserExporter::class),


                Action::make('importExcel')
                    ->label('ایمپورت اکسل')
                    ->form([
                        Forms\Components\FileUpload::make('file')
                            ->label('آپلود فایل اکسل')
                            ->directory('imports') // فایل‌ها داخل storage/app/public/imports ذخیره میشن
                            ->acceptedFileTypes([
                                'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                                'application/vnd.ms-excel',
                            ])
                            ->required(),
                    ])
                    ->action(function (array $data) {
                        try {
                            // مسیر کامل فایل روی سرور
                            $filePath = storage_path('app/public/' . $data['file']);

                            \Maatwebsite\Excel\Facades\Excel::import(
                                new \App\Imports\UsersImport,
                                $filePath
                            );

                            Notification::make()
                                ->title('با موفقیت اکسل وارد شد ✅')
                                ->success()
                                ->send();

                        } catch (\Exception $e) {
                            Notification::make()
                                ->title('مشکلی پیش آمده: ' . $e->getMessage())
                                ->danger()
                                ->send();
                        }
                    }),


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
                    ->label('ایجاد کاربر جدید'),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'view' => Pages\ViewUser::route('/{record}'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
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
