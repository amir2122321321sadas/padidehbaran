<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SettingResource\Pages;
use App\Filament\Resources\SettingResource\RelationManagers;
use App\Models\Setting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SettingResource extends Resource
{
    protected static ?string $model = Setting::class;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static ?string $navigationLabel = 'تنظیمات وبسایت';
    protected static ?string $navigationGroup = 'تنظیمات وبسایت';
    protected static ?string $modelLabel = 'تنظیمات';
    protected static ?string $pluralModelLabel = 'تنظیمات وبسایت';

    public static function canViewAny(): bool
    {
        return auth()->user()?->can('view setting');
    }

    public static function canCreate(): bool
    {
        return auth()->user()?->can('create setting');
    }

    public static function canEdit($record): bool
    {
        return auth()->user()?->can('edit setting');
    }

    public static function canDelete($record): bool
    {
        return auth()->user()?->can('delete setting');
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('اطلاعات کلی وبسایت')
                    ->schema([
                        Forms\Components\TextInput::make('web_name')
                            ->label('نام وبسایت')
                            ->helperText('نام وبسایت را وارد کنید(حداکثر:20 کاراکتر)')
                            ->required()
                            ->maxLength(20),

                        Forms\Components\Textarea::make('description')
                            ->label('توضیحات وبسایت')
                            ->helperText('توضیح کوتاهی درباره وبسایت وارد کنید(حداکثر:255 کاراکتر)')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),

                        Forms\Components\Textarea::make('about_we')
                            ->label('درباره ما')
                            ->helperText('درباره وبسایت و خودتان  توضیح بدهید (حداکثر:1800 کاراکتر)')
                            ->maxLength(1800)
                            ->required(),
                    ]),
                Forms\Components\Section::make('تنظیمات وضعیت و زمان‌بندی')
                    ->schema([
                        Forms\Components\Toggle::make('is_repair_mode')
                            ->label('حالت تعمیرات')
                            ->helperText('در صورت فعال بودن، سایت در حالت تعمیر قرار می‌گیرد')
                            ->required(),

                        Forms\Components\DateTimePicker::make('start_work_time')
                            ->label('زمان شروع فعالیت')
                            ->helperText('زمان شروع فعالیت سایت را انتخاب کنید')
                            ->required(),

                        Forms\Components\DateTimePicker::make('end_work_time')
                            ->label('زمان پایان فعالیت')
                            ->helperText('زمان پایان فعالیت سایت را انتخاب کنید')
                            ->required(),
                    ]),
                Forms\Components\Section::make('اطلاعات تماس و راه‌های ارتباطی')
                    ->schema([
                        Forms\Components\TextInput::make('phone')
                            ->label('شماره تماس')
                            ->helperText('شماره تماس وبسایت را وارد کنید')
                            ->required()
                            ->numeric()
                            ->columnSpanFull(),
                    ]),
                Forms\Components\Section::make('تصاویر و لوگوها')
                    ->schema([
                        Forms\Components\FileUpload::make('favicon')
                            ->label('فاوآیکون (Favicon)')
                            ->helperText('فاوآیکون سایت را انتخاب کنید')
                            ->required()
                            ->image()
                            ->downloadable()
                            ->openable()
                            ->directory('uploads/images/settings/images')
                            ->imageEditor()
                            ->columnSpanFull(),

                        Forms\Components\FileUpload::make('background_login_page')
                            ->label('تصویر پس‌زمینه صفحه ورود')
                            ->helperText(' تصویر پس‌زمینه صفحه ورود را انتخاب کنید')
                            ->required()
                            ->image()
                            ->imageEditor()
                            ->downloadable()
                            ->openable()
                            ->directory('uploads/images/settings/images')
                            ->columnSpanFull(),

                        Forms\Components\FileUpload::make('simple_logo')
                            ->label('لوگوی ساده')
                            ->helperText(' لوگوی ساده را انتخاب کنید')
                            ->required()
                            ->image()
                            ->directory('uploads/images/settings/images')
                            ->imageEditor()
                            ->downloadable()
                            ->openable()
                            ->columnSpanFull(),

                        Forms\Components\FileUpload::make('original_logo')
                            ->label('لوگوی اصلی')
                            ->helperText(' لوگوی اصلی را انتخاب کنید')
                            ->required()
                            ->image()
                            ->downloadable()
                            ->openable()
                            ->imageEditor()
                            ->directory('uploads/images/settings/images')
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('web_name')
                    ->label('نام وبسایت')
                    ->searchable(),

                Tables\Columns\TextColumn::make('about_we')
                    ->label('درباره ما')
                    ->sortable(),

                Tables\Columns\IconColumn::make('is_repair_mode')
                    ->label('حالت تعمیرات')
                    ->boolean(),

                Tables\Columns\TextColumn::make('start_work_time')
                    ->label('زمان شروع کاری')
                    ->dateTime('H:i')
                    ->sortable(),

                Tables\Columns\TextColumn::make('end_work_time')
                    ->label('زمان پایان کاری')
                    ->dateTime('H:i')
                    ->sortable(),

                Tables\Columns\ImageColumn::make('favicon')
                    ->label('فاوآیکون')
                    ->height(50),

                Tables\Columns\ImageColumn::make('background_login_page')
                    ->label('تصویر پس‌زمینه ورود')
                    ->height(50),

                Tables\Columns\ImageColumn::make('simple_logo')
                    ->label('لوگوی ساده')
                    ->height(50),

                Tables\Columns\ImageColumn::make('original_logo')
                    ->label('لوگوی اصلی')
                    ->height(50),

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
                    ->label('ایجاد اطلاعات تنظیمات وبسایت'),
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
            'index' => Pages\ListSettings::route('/'),
            'create' => Pages\CreateSetting::route('/create'),
            'view' => Pages\ViewSetting::route('/{record}'),
            'edit' => Pages\EditSetting::route('/{record}/edit'),
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
