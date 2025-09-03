<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserViewResource\Pages;
use App\Filament\Resources\UserViewResource\RelationManagers;
use App\Models\UserView;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserViewResource extends Resource
{
    protected static ?string $model = UserView::class;

    protected static ?string $navigationIcon = 'heroicon-o-eye';
    protected static ?string $navigationLabel = 'مشاهده‌های کاربران';
    protected static ?string $navigationGroup = 'مدیریت کاربران';
    protected static ?string $modelLabel = 'مشاهده کاربر';
    protected static ?string $pluralModelLabel = 'مشاهده‌های کاربران';
    protected static ?string $recordTitleAttribute = 'page_link';

    public static function getGloballySearchableAttributes(): array
    {
        return ['course.title' , 'total_time' , 'user.email' , 'courseFile.title' , 'page_link'];
    }

    public static function canViewAny(): bool
    {
        return auth()->user()?->can('view user view');
    }

    public static function canCreate(): bool
    {
        return auth()->user()?->can('create user view');
    }

    public static function canEdit($record): bool
    {
        return auth()->user()?->can('edit user view');
    }

    public static function canDelete($record): bool
    {
        return auth()->user()?->can('delete user view');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('اطلاعات مشاهده کاربر')
                    ->schema([
                        Forms\Components\TextInput::make('total_time')
                            ->label('مدت زمان مشاهده (دقیقه)')
                            ->helperText('مدت زمانی که کاربر مشاهده کرده است را وارد کنید')
                            ->required()
                            ->numeric(),

                        Forms\Components\Select::make('course_id')
                            ->label('دوره')
                            ->helperText('دوره مربوط به مشاهده را انتخاب کنید')
                            ->relationship('course', 'title')
                            ->searchable()
                            ->preload()
                            ->required(),

                        Forms\Components\Select::make('user_id')
                            ->label('کاربر')
                            ->helperText('کاربر مشاهده کننده را انتخاب کنید')
                            ->relationship('user', 'email')
                            ->searchable()
                            ->preload()
                            ->required(),

                        Forms\Components\Select::make('course_file_id')
                            ->label('فایل دوره')
                            ->helperText('در صورت نیاز فایل دوره را انتخاب کنید')
                            ->relationship('courseFile', 'title')
                            ->searchable()
                            ->preload()
                            ->nullable(),

                        Forms\Components\TextInput::make('page_link')
                            ->label('لینک صفحه')
                            ->helperText('آدرس صفحه‌ای که کاربر مشاهده کرده است را وارد کنید')
                            ->required()
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('total_time')
                    ->label('مدت زمان مشاهده (دقیقه)')
                    ->numeric()
                    ->sortable(),

                Tables\Columns\TextColumn::make('course.title')
                    ->label('عنوان دوره')
                    ->sortable()
                    ->searchable()
                    ->placeholder('بدون دوره'),

                Tables\Columns\TextColumn::make('user.email')
                    ->label('ایمیل کاربر')
                    ->sortable()
                    ->searchable()
                    ->placeholder('بدون کاربر'),

                Tables\Columns\TextColumn::make('courseFile.title')
                    ->label('عنوان فایل دوره')
                    ->sortable()
                    ->searchable()
                    ->placeholder('بدون فایل'),

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
                Tables\Filters\SelectFilter::make('user_id')
                    ->label('کاربر')
                    ->options(
                        User::query()
                            ->orderBy('email')
                            ->pluck('email', 'id')
                            ->toArray()
                    ),
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
                    ->label('ایجاد مشاهده کابر جدید'),
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
            'index' => Pages\ListUserViews::route('/'),
            'create' => Pages\CreateUserView::route('/create'),
            'view' => Pages\ViewUserView::route('/{record}'),
            'edit' => Pages\EditUserView::route('/{record}/edit'),
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
