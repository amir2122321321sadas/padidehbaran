<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MenuResource\Pages;
use App\Filament\Resources\MenuResource\RelationManagers;
use App\Models\Menu;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MenuResource extends Resource
{
    protected static ?string $model = Menu::class;

    protected static ?string $modelLabel = 'منو';
    protected static ?string $pluralModelLabel = 'منوها';
    protected static ?string $navigationLabel = 'منوها';
    protected static ?string $navigationGroup = 'محتوا وبسایت';
    protected static ?string $navigationIcon = 'heroicon-o-bars-3-bottom-left';
    protected static ?string $recordTitleAttribute = 'name';
    public static function getGloballySearchableAttributes(): array
    {
        return ['name', 'url'];
    }
    public static function canViewAny(): bool
    {
        return auth()->user()?->can('view menu');
    }

    public static function canCreate(): bool
    {
        return auth()->user()?->can('create menu');
    }

    public static function canEdit($record): bool
    {
        return auth()->user()?->can('edit menu');
    }

    public static function canDelete($record): bool
    {
        return auth()->user()?->can('delete menu');
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('اطلاعات منو')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('نام منو')
                            ->helperText('نام منو را وارد کنید')
                            ->required(),
                        Forms\Components\TextInput::make('url')
                            ->label('آدرس (URL)')
                            ->helperText('آدرس منو را وارد کنید')
                            ->required(),
                        Forms\Components\TextInput::make('icon')
                            ->label('آیکون')
                            ->helperText('کد یا نام آیکون را وارد کنید')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Select::make('permissions')
                            ->label('دسترسی‌ها')
                            ->helperText('دسترسی‌های مورد نیاز را وارد کنید')
                            ->required()
                            ->native(false)
                            ->options(\App\Models\Menu::PERMISSION_OPTIONS),
                        Forms\Components\Select::make('status')
                            ->label('وضعیت')
                            ->helperText('وضعیت منو را انتخاب کنید')
                            ->options(\App\Models\Menu::STATUS_OPTIONS)
                            ->native(false)
                            ->required(),
                        Forms\Components\Select::make('menu_id')
                            ->label('منوی والد')
                            ->options(fn () => \App\Models\Menu::pluck('name', 'id'))
                            ->searchable()
                            ->nullable()
                            ->helperText('در صورت نیاز منوی والد را انتخاب کنید'),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('نام منو')
                    ->sortable()
                    ->placeholder('_'),
                Tables\Columns\TextColumn::make('url')
                    ->label('آدرس (URL)')
                    ->sortable()
                    ->placeholder('_'),
                Tables\Columns\TextColumn::make('icon')
                    ->label('آیکون')
                    ->searchable()
                    ->placeholder('_'),
                Tables\Columns\SelectColumn::make('permissions')
                    ->label('دسترسی‌ها')
                    ->options(\App\Models\Menu::PERMISSION_OPTIONS)
                    ->disablePlaceholderSelection()
                    ->searchable()
                    ->placeholder('_'),
                Tables\Columns\SelectColumn::make('status')
                    ->label('وضعیت')
                    ->sortable()
                    ->disablePlaceholderSelection()
                    ->options(\App\Models\Menu::STATUS_OPTIONS)
                    ->placeholder('_'),
                Tables\Columns\TextColumn::make('parent.name')
                    ->label('منوی والد')
                    ->sortable()
                    ->placeholder('_'),
                Tables\Columns\TextColumn::make('children')
                    ->label('زیرمنوها')
                    ->formatStateUsing(fn($record) => $record->children->pluck('name')->implode(', '))
                    ->placeholder('_'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('تاریخ ایجاد')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->placeholder('_'),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('تاریخ بروزرسانی')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->placeholder('_'),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->label('تاریخ حذف')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->placeholder('_'),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make()
                    ->label('نمایش حذف‌شده‌ها'),
            ])
            ->actions([

                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                    Tables\Actions\ForceDeleteAction::make(),
                    Tables\Actions\RestoreAction::make(),
                    Tables\Actions\ViewAction::make()
                        ->label('مشاهده'),
                ])->label('عملیات'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->label('حذف'),
                    Tables\Actions\ForceDeleteBulkAction::make()
                        ->label('حذف دائمی'),
                    Tables\Actions\RestoreBulkAction::make()
                        ->label('بازیابی'),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make()
                    ->label('ایجاد منو جدید'),
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
            'index' => Pages\ListMenus::route('/'),
            'create' => Pages\CreateMenu::route('/create'),
            'view' => Pages\ViewMenu::route('/{record}'),
            'edit' => Pages\EditMenu::route('/{record}/edit'),
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
