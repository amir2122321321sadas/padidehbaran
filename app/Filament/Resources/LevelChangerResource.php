<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LevelChangerResource\Pages;
use App\Filament\Resources\LevelChangerResource\RelationManagers;
use App\Models\Level;
use App\Models\LevelChanger;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Spatie\Permission\Models\Permission;

class LevelChangerResource extends Resource
{
    protected static ?string $model = LevelChanger::class;

    protected static ?string $navigationIcon = 'heroicon-o-shield-check';
    protected static ?string $navigationLabel = 'تغییر دهنده سطح دسترسی ها';
    protected static ?string $navigationGroup = 'دوره‌ها';
    protected static ?string $modelLabel = 'تغییر دهنده سطح';
    protected static ?string $pluralModelLabel = 'تغییر دهنده های سطح دسترسی';

    public static function canViewAny(): bool
    {
        return auth()->user()?->can('view changer level');
    }

    public static function canCreate(): bool
    {
        return auth()->user()?->can('create changer level');
    }

    public static function canEdit($record): bool
    {
        return auth()->user()?->can('edit changer level');
    }

    public static function canDelete($record): bool
    {
        return auth()->user()?->can('delete changer level');
    }


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('اطلاعات سطح')
                    ->schema([

                        Forms\Components\TextInput::make('insurance_policies_number')
                            ->label('تعداد بیمه نامه‌ها')
                            ->required()
                            ->helperText('مقدار بیمه نامه های تایید شده مورد نیاز برای دستیابی به این سطح')
                            ->maxLength(255),

                        Forms\Components\TextInput::make('subtotal_number')
                            ->label('تعداد زیرمجموعه')
                            ->required()
                            ->helperText('مقدار افراد زیرمحموعه مورد نیاز برای دستیابی به این سطح')
                            ->maxLength(255),

                        Forms\Components\Toggle::make('status')
                            ->label('وضعیت فعال بودن')
                            ->default(true),
                    ]),

                Forms\Components\Section::make('دسترسی‌ها و نقش')
                    ->schema([


                        Forms\Components\Select::make('level_id')
                            ->label('سطح ها')
                            ->options(Level::all()->pluck('name', 'id'))
                            ->helperText('سطحی که به آن تغییر خواهد کرد')
                            ->preload()
                            ->searchable()
                            ->required()
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('level_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('insurance_policies_number')
                    ->searchable(),
                Tables\Columns\TextColumn::make('subtotal_number')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('role_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
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
                    ->label('ایجاد تغییر دهنده سطح جدید'),
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
            'index' => Pages\ListLevelChangers::route('/'),
            'create' => Pages\CreateLevelChanger::route('/create'),
            'view' => Pages\ViewLevelChanger::route('/{record}'),
            'edit' => Pages\EditLevelChanger::route('/{record}/edit'),
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
