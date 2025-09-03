<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ChangerItemResource\Pages;
use App\Filament\Resources\ChangerItemResource\RelationManagers;
use App\Models\ChangerItem;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ChangerItemResource extends Resource
{
    protected static ?string $model = ChangerItem::class;

    protected static ?string $navigationIcon = 'heroicon-o-adjustments-vertical'; // آیکون مناسب برای آیتم‌های تغییر
    protected static ?string $navigationLabel = 'آیتم‌ اسکرولی';
    protected static ?string $navigationGroup = 'محتوا وبسایت';
    protected static ?string $modelLabel = 'آیتم تغییر';
    protected static ?string $pluralModelLabel = 'آیتم‌های تغییر';
    protected static ?string $recordTitleAttribute = 'title';

    public static function canViewAny(): bool
    {
        return auth()->user()?->can('view changer');
    }

    public static function canCreate(): bool
    {
        return auth()->user()?->can('create changer');
    }

    public static function canEdit($record): bool
    {
        return auth()->user()?->can('edit changer');
    }

    public static function canDelete($record): bool
    {
        return auth()->user()?->can('delete changer');
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['title'];
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('اطلاعات آیتم تغییر')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('عنوان')
                            ->helperText('عنوان آیتم را وارد کنید')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Textarea::make('icon')
                            ->label('آیکون')
                            ->helperText('کد یا نام آیکون را وارد کنید')
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('description')
                            ->label('توضیحات')
                            ->helperText('توضیحات آیتم را وارد کنید')
                            ->required()
                            ->columnSpanFull(),
                        Forms\Components\FileUpload::make('image')
                            ->label('تصویر')
                            ->helperText('تصویر را وارد کنید')
                            ->required()
                            ->image()
                            ->imageEditor()
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('order')
                            ->label('ترتیب نمایش')
                            ->helperText('شماره ترتیب نمایش را وارد کنید')
                            ->numeric()
                            ->default(null),
                        Forms\Components\Toggle::make('status')
                            ->label('وضعیت')
                            ->helperText('فعال یا غیرفعال بودن آیتم را مشخص کنید')
                            ->required()
                            ->onColor('success')
                            ->offColor('danger')
                            ->onIcon('heroicon-o-check')
                            ->offIcon('heroicon-o-x-mark'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('عنوان')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('image')
                    ->label('تصویر')
                    ->height(48)
                    ->width(48),
                Tables\Columns\TextColumn::make('order')
                    ->label('ترتیب نمایش')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\ToggleColumn::make('status')
                    ->label('وضعیت')
                    ->onColor('success')
                    ->offColor('danger')
                    ->onIcon('heroicon-o-check')
                    ->offIcon('heroicon-o-x-mark')
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
                    ->label('ایجاد آیتم اسکرولی جدید'),
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
            'index' => Pages\ListChangerItems::route('/'),
            'create' => Pages\CreateChangerItem::route('/create'),
            'view' => Pages\ViewChangerItem::route('/{record}'),
            'edit' => Pages\EditChangerItem::route('/{record}/edit'),
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
