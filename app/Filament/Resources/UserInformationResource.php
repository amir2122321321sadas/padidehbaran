<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserInformationResource\Pages;
use App\Filament\Resources\UserInformationResource\RelationManagers;
use App\Models\UserInformation;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserInformationResource extends Resource
{
    protected static ?string $model = UserInformation::class;

    protected static ?string $navigationIcon = 'heroicon-o-identification';
    protected static ?string $navigationLabel = 'اطلاعات هویتی کاربران';
    protected static ?string $navigationGroup = 'مدیریت کاربران';
    protected static ?string $modelLabel = 'اطلاعات هویتی کاربر';
    protected static ?string $pluralModelLabel = 'اطلاعات هویتی کاربران';

    protected static ?string $recordTitleAttribute = 'national_code';

    public static function getGloballySearchableAttributes(): array
    {
        return [
            'user.email' ,
            'identification_code' ,
            'national_code' ,
            'first_name' ,
            'last_name' ,
            'father_name' ,
            'birth_certificate_number' ,
            'postal_code' ,
            'phone'
        ];
    }

    public static function canViewAny(): bool
    {
        return auth()->user()?->can('view user information');
    }

    public static function canCreate(): bool
    {
        return auth()->user()?->can('create user information');
    }

    public static function canEdit($record): bool
    {
        return auth()->user()?->can('edit user information');
    }

    public static function canDelete($record): bool
    {
        return auth()->user()?->can('delete user information');
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('اطلاعات هویتی کاربر')
                    ->schema([
                        Forms\Components\Select::make('user_id')
                            ->label('کاربر')
                            ->relationship('user', 'email')
                            ->preload()
                            ->searchable()
                            ->required()
                            ->helperText('کاربر مربوطه را انتخاب کنید (ایمیل کاربر را جستجو و انتخاب نمایید)'),
                        Forms\Components\TextInput::make('first_name')
                            ->label('نام')
                            ->helperText('نام کوچک کاربر را وارد کنید'),
                        Forms\Components\TextInput::make('last_name')
                            ->label('نام خانوادگی')
                            ->helperText('نام خانوادگی کاربر را وارد کنید'),
                        Forms\Components\TextInput::make('father_name')
                            ->label('نام پدر')
                            ->helperText('نام پدر کاربر را وارد کنید'),
                        Forms\Components\TextInput::make('national_code')
                            ->label('کد ملی')
                            ->required()
                            ->minLength(10)
                            ->maxLength(10)
                            ->helperText('کد ملی ۱۰ رقمی کاربر را وارد کنید')
                            ->rule('digits:10'),
                        Forms\Components\TextInput::make('birth_certificate_number')
                            ->label('شماره شناسنامه')
                            ->helperText('شماره شناسنامه کاربر را وارد کنید (اختیاری)'),
                        Forms\Components\DatePicker::make('date_of_birth')
                            ->label('تاریخ تولد')
                            ->helperText('تاریخ تولد کاربر را انتخاب کنید'),
                        Forms\Components\TextInput::make('phone')
                            ->label('شماره تماس')
                            ->tel()
                            ->numeric()
                            ->helperText('شماره تماس معتبر کاربر را وارد کنید'),
                        Forms\Components\TextInput::make('postal_code')
                            ->label('کد پستی')
                            ->minLength(10)
                            ->maxLength(10)
                            ->helperText('کد پستی محل سکونت کاربر را وارد کنید (اختیاری)')
                            ->rule('digits:10'),
                        Forms\Components\Textarea::make('address')
                            ->label('آدرس')
                            ->columnSpanFull()
                            ->helperText('آدرس کامل محل سکونت کاربر را وارد کنید'),
                        Forms\Components\Select::make('identification_code')
                            ->label('کد معرف')
                            ->relationship('user', 'identification_code')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->columnSpanFull()
                            ->helperText('کد معرف کاربر را از لیست انتخاب کنید (بر اساس کد معرف کاربران موجود)'),
                    ])->columns(
                        2
                    ),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.identification_code')
                    ->label('کد معرف')
                    ->placeholder('کد معرف ثبت نشده')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.email')
                    ->label('ایمیل کاربر')
                    ->placeholder('ایمیل ثبت نشده')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('first_name')
                    ->label('نام')
                    ->placeholder('نام ثبت نشده')
                    ->searchable(),
                Tables\Columns\TextColumn::make('last_name')
                    ->label('نام خانوادگی')
                    ->placeholder('نام خانوادگی ثبت نشده')
                    ->searchable(),
                Tables\Columns\TextColumn::make('father_name')
                    ->label('نام پدر')
                    ->placeholder('نام پدر ثبت نشده')
                    ->searchable(),
                Tables\Columns\TextColumn::make('national_code')
                    ->label('کد ملی')
                    ->placeholder('کد ملی ثبت نشده')
                    ->searchable(),
                Tables\Columns\TextColumn::make('birth_certificate_number')
                    ->label('شماره شناسنامه')
                    ->placeholder('شماره شناسنامه ثبت نشده')
                    ->searchable(),
                Tables\Columns\TextColumn::make('date_of_birth')
                    ->label('تاریخ تولد')
                    ->placeholder('تاریخ تولد ثبت نشده')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('phone')
                    ->label('شماره تماس')
                    ->placeholder('شماره تماس ثبت نشده')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('postal_code')
                    ->label('کد پستی')
                    ->placeholder('کد پستی ثبت نشده')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('تاریخ ایجاد')
                    ->placeholder('تاریخ ایجاد ثبت نشده')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('تاریخ بروزرسانی')
                    ->placeholder('تاریخ بروزرسانی ثبت نشده')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->label('تاریخ حذف')
                    ->placeholder('حذف نشده')
                    ->dateTime()
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
                    ->label('ایجاد اطلاعات کاربر جدید'),
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
            'index' => Pages\ListUserInformation::route('/'),
            'create' => Pages\CreateUserInformation::route('/create'),
            'view' => Pages\ViewUserInformation::route('/{record}'),
            'edit' => Pages\EditUserInformation::route('/{record}/edit'),
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
