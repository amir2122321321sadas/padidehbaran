<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CourseResource\Pages;
use App\Filament\Resources\CourseResource\RelationManagers;
use App\Models\Course;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Spatie\Permission\Models\Role;

class CourseResource extends Resource
{
    protected static ?string $model = Course::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    protected static ?string $navigationLabel = 'دوره‌ها';
    protected static ?string $navigationGroup = 'دوره‌ها';
    protected static ?string $modelLabel = 'دوره';
    protected static ?string $pluralModelLabel = 'دوره‌ها';
    protected static ?string $recordTitleAttribute = 'title';

    public static function getGloballySearchableAttributes(): array
    {
        return ['title' , 'total_files' , 'published_at' , 'category.name' , 'teacher.email'];
    }

    public static function canViewAny(): bool
    {
        return auth()->user()?->can('view course');
    }

    public static function canCreate(): bool
    {
        return auth()->user()?->can('create course');
    }

    public static function canEdit($record): bool
    {
        return auth()->user()?->can('edit course');
    }

    public static function canDelete($record): bool
    {
        return auth()->user()?->can('delete course');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('اطلاعات دوره')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('عنوان دوره')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Textarea::make('summary_description')
                            ->label('توضیح کوتاه')
                            ->required()
                            ->columnSpanFull()
                            ->maxLength(255),
                        Forms\Components\RichEditor::make('description')
                            ->label('توضیحات کامل')
                            ->required()
                            ->columnSpanFull(),
                        Forms\Components\ColorPicker::make('them_color')
                            ->label('رنگ تم')
                            ->required(),
                        Forms\Components\TextInput::make('total_files')
                            ->label('تعداد فایل‌ها')
                            ->required()
                            ->numeric(),
                        Forms\Components\FileUpload::make('image')
                            ->label(' تصویر')
                            ->required()
                            ->image()
                            ->imageEditor()
                            ->rule('mimes:jpg,jpeg,png')
                            ->directory('uploads/images/course/images')
                            ->columnSpanFull(),
                        Forms\Components\DatePicker::make('published_at')
                            ->label('تاریخ انتشار')
                            ->required(),
                        Forms\Components\TextInput::make('total_time')
                            ->label('مدت دوره(دقیقه)')
                            ->required()
                            ->maxLength(255),
                    ])
                ->columns(2),
                Forms\Components\Section::make('دسته‌بندی و مدرس')
                    ->schema([
                        Forms\Components\Select::make('category_id')
                            ->label('دسته‌بندی')
                            ->relationship('category', 'name')
                            ->required()
                            ->preload()
                            ->searchable(),
                        Forms\Components\Select::make('teacher_id')
                            ->label('مدرس')
                            ->relationship('teacher', 'email')
                            ->required()
                            ->preload()
                            ->searchable(),
                    ]),
                Forms\Components\Section::make('وضعیت')
                    ->schema([
                        Forms\Components\Select::make('access_levels')
                            ->label('سطوح دسترسی')
                            ->helperText('سطوح دسترسی مجاز را انتخاب کنید')
                            ->required()
                            ->multiple()
                            ->options(Role::all()->pluck('name', 'id'))
                            ->searchable()
                            ->preload()
                            ->columnSpanFull()
                            ->dehydrateStateUsing(fn ($state) => $state ? json_encode($state) : null)
                            ->formatStateUsing(fn ($state) => $state ? json_decode($state, true) : []),
                        Forms\Components\Toggle::make('status')
                            ->label('وضعیت')
                            ->helperText('فعال یا غیرفعال بودن دوره را مشخص کنید')
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
                    ->label('عنوان دوره')
                    ->searchable(),
                Tables\Columns\TextColumn::make('summary_description')
                    ->label('توضیح خلاصه')
                    ->searchable()
                    ->limit(40)
                    ->columnSpanFull(),
                Tables\Columns\ImageColumn::make('image')
                    ->label('تصویر دوره')
                    ->height(48)
                ,
                Tables\Columns\TextColumn::make('total_files')
                    ->label('تعداد فایل‌ها')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\ToggleColumn::make('status')
                    ->label('وضعیت')
                    ->onColor('success')
                    ->offColor('danger')
                    ->onIcon('heroicon-o-check')
                    ->offIcon('heroicon-o-x-mark')
                    ->sortable(),
                Tables\Columns\ColorColumn::make('them_color')
                    ->label('رنگ تم دوره')
                    ->searchable(),
                Tables\Columns\TextColumn::make('category.name')
                    ->label('دسته‌بندی')
                    ->sortable()
                    ->searchable()
                    ->placeholder('بدون دسته‌بندی'),
                Tables\Columns\TextColumn::make('teacher.email')
                    ->label('مدرس')
                    ->sortable()
                    ->searchable()
                    ->placeholder('بدون مدرس'),
                Tables\Columns\TextColumn::make('published_at')
                    ->label('تاریخ انتشار')
                    ->date('Y/m/d')
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
                    ->label('ایجاد دوره جدید'),
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
            'index' => Pages\ListCourses::route('/'),
            'create' => Pages\CreateCourse::route('/create'),
            'view' => Pages\ViewCourse::route('/{record}'),
            'edit' => Pages\EditCourse::route('/{record}/edit'),
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
