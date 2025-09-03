<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserNationalityDataResource\Pages;
use App\Filament\Resources\UserNationalityDataResource\RelationManagers;
use App\Models\UserNationalityData;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserNationalityDataResource extends Resource
{
    protected static ?string $model = UserNationalityData::class;

    protected static ?string $navigationIcon = 'heroicon-o-identification';
    protected static ?string $navigationLabel = 'اطلاعات هویتی کاربران (تصویر کارت ملی و...)';
    protected static ?string $navigationGroup = 'مدیریت کاربران';
    protected static ?string $modelLabel = 'اطلاعات هویتی کاربر';
    protected static ?string $pluralModelLabel = 'اطلاعات هویتی کاربران';
    protected static ?string $recordTitleAttribute = 'card_number';

    public static function getGloballySearchableAttributes(): array
    {
        return ['shaba_number' , 'card_number', 'user.email'];
    }

    public static function canViewAny(): bool
    {
        return auth()->user()?->can('view user nationality');
    }

    public static function canCreate(): bool
    {
        return auth()->user()?->can('create user nationality');
    }

    public static function canEdit($record): bool
    {
        return auth()->user()?->can('edit user nationality');
    }

    public static function canDelete($record): bool
    {
        return auth()->user()?->can('delete user nationality');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('اطلاعات هویتی')
                    ->schema([
                        Forms\Components\Select::make('user_id')
                            ->label('کاربر')
                            ->helperText('کاربر مربوطه را انتخاب کنید')
                            ->relationship('user', 'email')
                            ->required()
                            ->searchable()
                            ->preload(),
                        Forms\Components\TextInput::make('card_number')
                            ->label('شماره کارت (فقط ملت)')
                            ->helperText('شماره کارت(فقط ملت) را وارد کنید')
                            ->required()
                            ->hint('درصورت اشتباه وارد شدن مسئولیت برعهده کاربر است')
                            ->maxLength(16)
                            ->minLength(16)
                            ->rule('digits:16')
                            ->numeric(),
                        Forms\Components\TextInput::make('shaba_number')
                            ->label('شماره شبا(فقط ملت)')
                            ->hint('درصورت اشتباه وارد شدن مسئولیت برعهده کاربر است')
                            ->helperText('شماره شبا را وارد کنید(فقط ملت)')
                            ->required(),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('تصاویر مدارک')
                    ->schema([
                        Forms\Components\FileUpload::make('image_national_card')
                            ->label('تصویر کارت ملی')
                            ->helperText('تصویر کارت ملی را بارگذاری کنید')
                            ->required()
                            ->image()
                            ->lazy()
                            ->downloadable()
                            ->openable()
                            ->imageEditor()
                            ->directory('uploads/images/nationality/national_card')
                            ->columnSpanFull(),
                        Forms\Components\FileUpload::make('birth_certificate')
                            ->label('تصویر شناسنامه')
                            ->helperText('تصویر شناسنامه را بارگذاری کنید')
                            ->required()
                            ->image()
                            ->lazy()
                            ->downloadable()
                            ->openable()
                            ->imageEditor()
                            ->directory('uploads/images/nationality/birth_certificate')
                            ->columnSpanFull(),
                        Forms\Components\FileUpload::make('face_image')
                            ->label('تصویر چهره')
                            ->helperText('تصویر چهره را بارگذاری کنید')
                            ->required()
                            ->image()
                            ->lazy()
                            ->downloadable()
                            ->openable()
                            ->imageEditor()
                            ->directory('uploads/nationality/face_image')
                            ->columnSpanFull(),
                        Forms\Components\FileUpload::make('image_educational_qualification')
                            ->label('تصویر مدرک تحصیلی')
                            ->helperText('تصویر مدرک تحصیلی را بارگذاری کنید')
                            ->required()
                            ->image()
                            ->lazy()
                            ->downloadable()
                            ->openable()
                            ->imageEditor()
                            ->directory('uploads/images/nationality/educational_qualification')
                            ->columnSpanFull(),
                        Forms\Components\FileUpload::make('image_promissory_note')
                            ->label('تصویر سفته')
                            ->helperText('تصویر سفته را بارگذاری کنید')
                            ->required()
                            ->image()
                            ->lazy()
                            ->downloadable()
                            ->openable()
                            ->imageEditor()
                            ->directory('uploads/images/nationality/promissory_note')
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.email')
                    ->label('ایمیل کاربر')
                    ->sortable()
                    ->searchable()
                    ->placeholder('بدون کاربر'),
                Tables\Columns\TextColumn::make('card_number')
                    ->label('شماره کارت ملی')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\ImageColumn::make('image_national_card')
                    ->label('تصویر کارت ملی')
                    ->height(48)
                    ->circular()
                    ->toggleable(isToggledHiddenByDefault: false),
                Tables\Columns\ImageColumn::make('face_image')
                    ->label('تصویر چهره')
                    ->height(48)
                    ->circular()
                    ->toggleable(isToggledHiddenByDefault: false),
                Tables\Columns\ImageColumn::make('image_educational_qualification')
                    ->label('تصویر مدرک تحصیلی')
                    ->height(48)
                    ->circular()
                    ->toggleable(isToggledHiddenByDefault: false),
                Tables\Columns\ImageColumn::make('image_promissory_note')
                    ->label('تصویر سفته')
                    ->height(48)
                    ->circular()
                    ->toggleable(isToggledHiddenByDefault: false),
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
                    ->label('ایجاد اطلاعات کاربری(تصویر کارت ملی و...) جدید'),
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
            'index' => Pages\ListUserNationalityData::route('/'),
            'create' => Pages\CreateUserNationalityData::route('/create'),
            'view' => Pages\ViewUserNationalityData::route('/{record}'),
            'edit' => Pages\EditUserNationalityData::route('/{record}/edit'),
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
