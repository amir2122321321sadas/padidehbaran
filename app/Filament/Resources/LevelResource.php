<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LevelResource\Pages;
use App\Filament\Resources\LevelResource\RelationManagers;
use App\Models\Course;
use App\Models\Level;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LevelResource extends Resource
{
    protected static ?string $model = Level::class;

    protected static ?string $navigationIcon = 'heroicon-o-sparkles';
    protected static ?string $navigationLabel = 'سطوح';
    protected static ?string $modelLabel = 'سطح';
    protected static ?string $pluralModelLabel = 'سطوح';
    protected static ?string $navigationGroup = 'دوره‌ها';

    public static function canViewAny(): bool
    {
        return auth()->user()?->can('view level course');
    }

    public static function canCreate(): bool
    {
        return auth()->user()?->can('create level course');
    }

    public static function canEdit($record): bool
    {
        return auth()->user()?->can('edit level course');
    }

    public static function canDelete($record): bool
    {
        return auth()->user()?->can('delete level course');
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('اطلاعات سطح')
                    ->schema([
                        Forms\Components\TextInput::make('order_level')
                            ->label('ترتیب سطح')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('مثلاً ۱'),
                        Forms\Components\TextInput::make('name')
                            ->label('نام سطح')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('نام سطح را وارد کنید'),
                        Forms\Components\Textarea::make('description')
                            ->label('توضیحات')
                            ->placeholder('توضیحات سطح را وارد کنید')
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('icon')
                            ->label('آیکون')
                            ->placeholder('کد آیکون یا نام آیکون را وارد کنید')
                            ->columnSpanFull(),
                        Forms\Components\Select::make('course_id')
                            ->label('دوره‌ها')
                            ->options(Course::all()->pluck('title', 'id'))
                            ->multiple()
                            ->required()
                            ->searchable()
                            ->preload()
                            ->placeholder('انتخاب دوره‌ها')
                            ->columnSpanFull()
                            ->dehydrateStateUsing(fn ($state) => $state ? json_encode($state) : null)
                            ->formatStateUsing(fn ($state) => $state ? json_decode($state, true) : []),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('order_level')
                    ->label('ترتیب سطح')
                    ->searchable(),
                Tables\Columns\TextColumn::make('name')
                    ->label('نام سطح')
                    ->searchable(),
                Tables\Columns\TextColumn::make('course_id')
                    ->label('دوره‌ها')
                    ->formatStateUsing(function ($state) {
                        if (!$state) {
                            return '-';
                        }
                        $ids = is_array($state) ? $state : json_decode($state, true);
                        if (!is_array($ids)) {
                            return '-';
                        }
                        $titles = \App\Models\Course::whereIn('id', $ids)->pluck('title')->toArray();
                        return implode('، ', $titles);
                    }),
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
                    ->label('ایجاد سطح جدید'),
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
            'index' => Pages\ListLevels::route('/'),
            'create' => Pages\CreateLevel::route('/create'),
            'view' => Pages\ViewLevel::route('/{record}'),
            'edit' => Pages\EditLevel::route('/{record}/edit'),
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
