<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BannerResource\Pages;
use App\Filament\Resources\BannerResource\RelationManagers;
use App\Models\Banner;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BannerResource extends Resource
{
    protected static ?string $model = Banner::class;
    protected static ?string $navigationLabel = 'بنر ها';

    protected static ?string $navigationGroup = 'محتوا وبسایت';

    protected static ?string $modelLabel = 'بنر';
    protected static ?string $pluralModelLabel = 'بنر ها';
    protected static ?string $recordTitleAttribute = 'title';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';


    public static function canViewAny(): bool
    {
        return auth()->user()?->can('view banner');
    }

    public static function canCreate(): bool
    {
        return auth()->user()?->can('create banner');
    }

    public static function canEdit($record): bool
    {
        return auth()->user()?->can('edit banner');
    }

    public static function canDelete($record): bool
    {
        return auth()->user()?->can('delete banner');
    }


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('اطلاعات بنر')
                    ->schema([
                        Forms\Components\Select::make('location')
                            ->required()
                            ->label('موقعیت قرارگیری')
                            ->native(false)
                            ->options(Banner::LOCATION_OPTIONS),
                        Forms\Components\TextInput::make('title')
                            ->label('عنوان')
                            ->columnSpanFull()
                            ->maxLength(20)
                            ->default(null),
                        Forms\Components\TextInput::make('description')
                            ->maxLength(255)
                            ->columnSpanFull()
                            ->label('توضیحات')
                            ->default(null),
                        Forms\Components\TextInput::make('url')
                            ->label('لینک بنر')
                            ->columnSpanFull(),
                        Forms\Components\FileUpload::make('image')
                            ->required()
                            ->label('تصویر')
                            ->imageEditor()
                            ->image()
                            ->downloadable()
                            ->directory('uploads/images/Banners/Images')
                            ->rule('mimes:jpg,jpeg,png')
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('head_amazing_text')
                            ->maxLength(10)
                            ->label('نوشته بالا سمت راست')
                            ->hint('نوشته بالا سمت راست داخل یک باکس رنگی(مثال:شگفت انگیز)')
                            ->default(null),
                        Forms\Components\TextInput::make('left_head_amazing_text')
                            ->maxLength(10)
                            ->label('نوشته بالا سمت چپ')
                            ->default(null),
                        Forms\Components\TextInput::make('right_button_text_with_icon')
                            ->required()
                            ->maxLength(10)
                            ->label('متن دکمه سمت راست')
                            ->hint('متن دکمه سمت راست در بعضی از نوع بنر ها قابل استفاده است نه در همه بنر ها'),
                        Forms\Components\TextInput::make('left_button_text_with_icon')
                            ->required()
                            ->maxLength(10)
                            ->label('متن دکمه سمت چپ')
                            ->hint('متن دکمه سمت چپ در بعضی از نوع بنر ها قابل استفاده است نه در همه بنر ها'),
                        Forms\Components\Textarea::make('advantages_with_icon')
                            ->label('آیکون سمت راست نوشته بالا سمت راست')
                            ->hint('آیکون سمت راست نوشته بالا سمت راست')
                            ->columnSpanFull(),
                        Forms\Components\Toggle::make('status')
                            ->label('وضعیت')
                            ->required()
                            ->onColor('success')
                            ->offColor('danger')
                            ->onIcon('heroicon-o-check')
                            ->offIcon('heroicon-o-x-mark'),
                    ])->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\SelectColumn::make('location')
                    ->label('موقعیت بنر')
                    ->disablePlaceholderSelection()
                    ->options(Banner::LOCATION_OPTIONS),
                Tables\Columns\TextColumn::make('title')
                    ->label('عنوان')
                    ->searchable(),
                Tables\Columns\TextColumn::make('description')
                    ->label('توضیحات')
                    ->searchable(),
                Tables\Columns\ToggleColumn::make('status')
                    ->label('وضعیت')
                    ->onColor('success')
                    ->offColor('danger')
                    ->onIcon('heroicon-o-check')
                    ->offIcon('heroicon-o-x-mark')
                    ->sortable(),
                Tables\Columns\TextColumn::make('head_amazing_text')
                    ->label('نوشته شگفت انگیز')
                    ->searchable(),
                Tables\Columns\TextColumn::make('left_head_amazing_text')
                    ->label('نوشته چپ شگفت انگیز')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->label('ساخته شده در')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->label('ویرایش شده در')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->label('حذف شده در')
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
                    ->label('ایجاد بنر جدید'),
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
            'index' => Pages\ListBanners::route('/'),
            'create' => Pages\CreateBanner::route('/create'),
            'view' => Pages\ViewBanner::route('/{record}'),
            'edit' => Pages\EditBanner::route('/{record}/edit'),
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
