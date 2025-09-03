<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PageContactUsResource\Pages;
use App\Filament\Resources\PageContactUsResource\RelationManagers;
use App\Models\PageContactUs;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PageContactUsResource extends Resource
{
    protected static ?string $model = PageContactUs::class;

    protected static ?string $navigationIcon = 'heroicon-o-phone-arrow-up-right';
    protected static ?string $navigationLabel = 'صفحه تماس با ما';
    protected static ?string $navigationGroup = 'محتوا وبسایت';
    protected static ?string $modelLabel = 'صفحه تماس با ما';
    protected static ?string $pluralModelLabel = 'صفحات تماس با ما';

    public static function canViewAny(): bool
    {
        return auth()->user()?->can('view contactUs page');
    }

    public static function canCreate(): bool
    {
        return auth()->user()?->can('create contactUs page');
    }

    public static function canEdit($record): bool
    {
        return auth()->user()?->can('edit contactUs page');
    }

    public static function canDelete($record): bool
    {
        return auth()->user()?->can('delete contactUs page');
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('اطلاعات صفحه تماس با ما')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('عنوان صفحه')
                            ->helperText('عنوان صفحه تماس با ما را وارد کنید')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\Textarea::make('description')
                            ->label('توضیحات')
                            ->helperText('توضیحات مربوط به صفحه تماس با ما را وارد کنید')
                            ->required()
                            ->columnSpanFull(),

                        Forms\Components\Textarea::make('news')
                            ->label('اخبار یا پیام')
                            ->helperText('متن اخبار یا پیام مربوط به تماس با ما را وارد کنید')
                            ->required()
                            ->columnSpanFull(),

                        Forms\Components\TextInput::make('phone')
                            ->label('شماره تماس')
                            ->helperText('شماره تماس را وارد کنید')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),

                        Forms\Components\Textarea::make('address')
                            ->label('آدرس')
                            ->helperText('آدرس کامل را وارد کنید')
                            ->required()
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('عنوان صفحه')
                    ->searchable(),

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
                    ->label('ایجاد اطلاعات صفحه'),
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
            'index' => Pages\ListPageContactUs::route('/'),
            'create' => Pages\CreatePageContactUs::route('/create'),
            'view' => Pages\ViewPageContactUs::route('/{record}'),
            'edit' => Pages\EditPageContactUs::route('/{record}/edit'),
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
