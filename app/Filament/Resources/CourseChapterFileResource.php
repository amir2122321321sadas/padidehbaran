<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CourseChapterFileResource\Pages;
use App\Filament\Resources\CourseChapterFileResource\RelationManagers;
use App\Models\CourseChapterFile;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CourseChapterFileResource extends Resource
{
    protected static ?string $model = CourseChapterFile::class;

    protected static ?string $navigationIcon = 'heroicon-o-film';
    protected static ?string $navigationLabel = 'فایل‌های فصل';
    protected static ?string $navigationGroup = 'دوره‌ها';
    protected static ?string $modelLabel = 'فایل فصل';
    protected static ?string $pluralModelLabel = 'فایل‌های فصل';
    protected static ?string $recordTitleAttribute = 'title';

    public static function getGloballySearchableAttributes(): array
    {
        return ['title' , 'total_time' , 'courseChapter.title' , 'course.title'];
    }
    public static function canViewAny(): bool
    {
        return auth()->user()?->can('view file chapter');
    }

    public static function canCreate(): bool
    {
        return auth()->user()?->can('create file chapter');
    }

    public static function canEdit($record): bool
    {
        return auth()->user()?->can('edit file chapter');
    }

    public static function canDelete($record): bool
    {
        return auth()->user()?->can('delete file chapter');
    }


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('اطلاعات فایل فصل')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('عنوان فایل')
                            ->helperText('عنوان فایل را وارد کنید')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Textarea::make('description')
                            ->label('توضیحات')
                            ->helperText('توضیحی درباره فایل وارد کنید')
                            ->required()
                            ->columnSpanFull(),
                        Forms\Components\FileUpload::make('video')
                            ->label('آدرس ویدیو')
                            ->helperText('آدرس ویدیوی فایل را وارد کنید')
                            ->required()
                            ->rules('mimetypes:video/mp4,video/avi')
                            ->directory('uploads/videos/courseChapterFiles/videos')
                            ->maxSize(200000)
                            ->columnSpanFull(),
                        Forms\Components\FileUpload::make('cover')
                            ->label('کاور ویدیو')
                            ->helperText('آدرس تصویر کاور ویدیو را وارد کنید')
                            ->required()
                            ->image()
                            ->imageEditor()
                            ->directory('uploads/images/courseChapterFiles/covers')
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('total_time')
                            ->label('مدت زمان (دقیقه)')
                            ->helperText('مدت زمان ویدیو را به دقیقه وارد کنید')
                            ->required()
                            ->numeric(),
                        Forms\Components\TextInput::make('order')
                            ->label('ترتیب نمایش')
                            ->helperText('شماره ترتیب فایل را وارد کنید')
                            ->required()
                            ->numeric(),

                    ])
                    ->columns(2),

                Forms\Components\Section::make('ارتباطات و دسترسی')
                    ->schema([
                        Forms\Components\Select::make('course_chapter_id')
                            ->label('فصل دوره')
                            ->helperText('فصل مربوط به این فایل را انتخاب کنید')
                            ->relationship('courseChapter', 'title')
                            ->required()
                            ->searchable()
                            ->preload(),
                        Forms\Components\Select::make('course_id')
                            ->label('دوره')
                            ->helperText('دوره مربوط به این فایل را انتخاب کنید')
                            ->relationship('course', 'title')
                            ->required()
                            ->searchable()
                            ->preload(),
                        Forms\Components\Select::make('teacher_id')
                            ->label('مدرس')
                            ->helperText('مدرس این فایل را انتخاب کنید')
                            ->relationship('teacher', 'email')
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
                    ])
                    ->columns(2),

                Forms\Components\Section::make('وضعیت')
                    ->schema([
                        Forms\Components\Toggle::make('status')
                            ->label('وضعیت')
                            ->helperText('فعال یا غیرفعال بودن فایل را مشخص کنید')
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
                    ->label('عنوان فایل')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('cover')
                    ->label('تصویر فایل')
                    ->height(48),
                Tables\Columns\TextColumn::make('courseChapter.title')
                    ->label('فصل')
                    ->sortable()
                    ->placeholder('بدون فصل'),
                Tables\Columns\TextColumn::make('total_time')
                    ->label('مدت زمان کل (دقیقه)')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('order')
                    ->label('ترتیب')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\ToggleColumn::make('status')
                    ->label('وضعیت')
                    ->onColor('success')
                    ->offColor('danger')
                    ->onIcon('heroicon-o-check')
                    ->offIcon('heroicon-o-x-mark')
                    ->sortable(),
                Tables\Columns\TextColumn::make('course.title')
                    ->label('دوره')
                    ->sortable()
                    ->placeholder('بدون دوره'),
                Tables\Columns\TextColumn::make('teacher.email')
                    ->label('مدرس')
                    ->sortable()
                    ->placeholder('بدون مدرس'),
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
                    ->label('ایجاد فایل فصل جدید'),
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
            'index' => Pages\ListCourseChapterFiles::route('/'),
            'create' => Pages\CreateCourseChapterFile::route('/create'),
            'view' => Pages\ViewCourseChapterFile::route('/{record}'),
            'edit' => Pages\EditCourseChapterFile::route('/{record}/edit'),
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
