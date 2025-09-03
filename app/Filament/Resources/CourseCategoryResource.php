<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CourseCategoryResource\Pages;
use App\Filament\Resources\CourseCategoryResource\RelationManagers;
use App\Models\CourseCategory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Spatie\Permission\Models\Role;

class CourseCategoryResource extends Resource
{
    protected static ?string $model = CourseCategory::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'دسته‌بندی دوره‌ها';
    protected static ?string $navigationGroup = 'دوره‌ها';
    protected static ?string $modelLabel = 'دسته‌بندی دوره';
    protected static ?string $pluralModelLabel = 'دسته‌بندی دوره‌ها';
    protected static ?string $recordTitleAttribute = 'name';

    public static function getGloballySearchableAttributes(): array
    {
        return ['name' , 'user.email' , 'parent.name'];
    }

    public static function canViewAny(): bool
    {
        return auth()->user()?->can('view course category');
    }

    public static function canCreate(): bool
    {
        return auth()->user()?->can('create course category');
    }

    public static function canEdit($record): bool
    {
        return auth()->user()?->can('edit course category');
    }

    public static function canDelete($record): bool
    {
        return auth()->user()?->can('delete course category');
    }


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('اطلاعات دسته‌بندی دوره')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('نام دسته‌بندی')
                            ->helperText('نام دسته‌بندی را وارد کنید')
                            ->required()
                            ->maxLength(25),
                        Forms\Components\Textarea::make('description')
                            ->label('توضیحات')
                            ->helperText('توضیحی درباره دسته‌بندی وارد کنید')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),
                        Forms\Components\FileUpload::make('image')
                            ->label('تصویر')
                            ->helperText('آدرس یا کد تصویر را وارد کنید')
                            ->required()
                            ->image()
                            ->imageEditor()
                            ->directory('uploads/images/CourseCategory/Images')
                            ->rule('mimes:jpg,jpeg,png')
                            ->columnSpanFull(),
                        Forms\Components\Toggle::make('status')
                            ->label('وضعیت')
                            ->helperText('فعال یا غیرفعال بودن دسته‌بندی را مشخص کنید')
                            ->required()
                            ->onColor('success')
                            ->offColor('danger')
                            ->onIcon('heroicon-o-check')
                            ->offIcon('heroicon-o-x-mark'),
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
                        Forms\Components\Select::make('user_id')
                            ->label('کاربر ایجادکننده')
                            ->helperText('یک کاربر را انتخاب کنید')
                            ->required()
                            ->relationship('user', 'email')
                            ->searchable()
                            ->preload(),
                        Forms\Components\Select::make('category_id')
                            ->label('دسته‌بندی والد')
                            ->options(CourseCategory::where('category_id' , null)->get()->pluck('name', 'id'))
                            ->helperText('دسته‌بندی والد را انتخاب کنید'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('نام دسته‌بندی')
                    ->searchable(),
                Tables\Columns\ToggleColumn::make('status')
                    ->label('وضعیت')
                    ->onColor('success')
                    ->offColor('danger')
                    ->onIcon('heroicon-o-check')
                    ->offIcon('heroicon-o-x-mark')
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.userInformation.national_code')
                    ->label('کاربر ایجادکننده')
                    ->sortable(),
                Tables\Columns\TextColumn::make('parent.name')
                    ->label('دسته‌بندی والد')
                    ->placeholder('دسته بندی والد ندارد')
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
                    ->label('ایجاد دسته بندی دوره جدید'),
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
            'index' => Pages\ListCourseCategories::route('/'),
            'create' => Pages\CreateCourseCategory::route('/create'),
            'view' => Pages\ViewCourseCategory::route('/{record}'),
            'edit' => Pages\EditCourseCategory::route('/{record}/edit'),
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
