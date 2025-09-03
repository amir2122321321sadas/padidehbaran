<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CourseChapterResource\Pages;
use App\Filament\Resources\CourseChapterResource\RelationManagers;
use App\Models\CourseChapter;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CourseChapterResource extends Resource
{
    protected static ?string $model = CourseChapter::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';
    protected static ?string $navigationLabel = 'فصل‌های دوره';
    protected static ?string $navigationGroup = 'دوره‌ها';
    protected static ?string $modelLabel = 'فصل دوره';
    protected static ?string $pluralModelLabel = 'فصل‌های دوره';
    protected static ?string $recordTitleAttribute = 'title';

    public static function getGloballySearchableAttributes(): array
    {
        return ['title' , 'course.title'];
    }
    public static function canViewAny(): bool
    {
        return auth()->user()?->can('view chapter');
    }

    public static function canCreate(): bool
    {
        return auth()->user()?->can('create chapter');
    }

    public static function canEdit($record): bool
    {
        return auth()->user()?->can('edit chapter');
    }

    public static function canDelete($record): bool
    {
        return auth()->user()?->can('delete chapter');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('اطلاعات فصل دوره')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('عنوان فصل')
                            ->helperText('عنوان فصل را وارد کنید')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Textarea::make('description')
                            ->label('توضیحات')
                            ->helperText('توضیحی درباره فصل وارد کنید')
                            ->required()
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('order')
                            ->label('ترتیب')
                            ->helperText('شماره ترتیب فصل را وارد کنید')
                            ->required()
                            ->numeric(),
                        Forms\Components\TextInput::make('name_order')
                            ->label('نام ترتیب')
                            ->helperText('نام ترتیب را وارد کنید')
                            ->required()
                            ->maxLength(25),
                        Forms\Components\Select::make('course_id')
                            ->label('دوره')
                            ->helperText('دوره مربوط به این فصل را انتخاب کنید')
                            ->relationship('course', 'title')
                            ->required()
                            ->searchable()
                            ->preload(),
                        Forms\Components\Select::make('access_levels')
                            ->label('سطوح دسترسی')
                            ->helperText('سطوح دسترسی مجاز را انتخاب کنید')
                            ->required()
                            ->multiple()
                            ->options(\Spatie\Permission\Models\Role::all()->pluck('name', 'id'))
                            ->searchable()
                            ->preload()
                            ->columnSpanFull()
                            ->dehydrateStateUsing(fn ($state) => $state ? json_encode($state) : null)
                            ->formatStateUsing(fn ($state) => $state ? json_decode($state, true) : []),
                        Forms\Components\Toggle::make('status')
                            ->label('وضعیت')
                            ->helperText('فعال یا غیرفعال بودن فصل را مشخص کنید')
                            ->required()
                            ->onColor('success')
                            ->offColor('danger')
                            ->onIcon('heroicon-o-check')
                            ->offIcon('heroicon-o-x-mark'),
                    ])
                ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('عنوان فصل')
                    ->searchable(),
                Tables\Columns\TextColumn::make('order')
                    ->label('ترتیب')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('name_order')
                    ->label('نام ترتیب')
                    ->searchable(),
                Tables\Columns\ToggleColumn::make('status')
                    ->label('وضعیت')
                    ->onColor('success')
                    ->offColor('danger')
                    ->onIcon('heroicon-o-check')
                    ->offIcon('heroicon-o-x-mark')
                    ->sortable(),
                Tables\Columns\TextColumn::make('course.title')
                    ->label('عنوان دوره')
                    ->sortable()
                    ->searchable()
                    ->placeholder('بدون دوره'),

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
                    ->label('ایجاد فصل دوره جدید'),
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
            'index' => Pages\ListCourseChapters::route('/'),
            'create' => Pages\CreateCourseChapter::route('/create'),
            'view' => Pages\ViewCourseChapter::route('/{record}'),
            'edit' => Pages\EditCourseChapter::route('/{record}/edit'),
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
