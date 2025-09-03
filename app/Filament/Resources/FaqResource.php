<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FaqResource\Pages;
use App\Filament\Resources\FaqResource\RelationManagers;
use App\Models\Faq;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FaqResource extends Resource
{
    protected static ?string $model = Faq::class;

    protected static ?string $navigationIcon = 'heroicon-o-question-mark-circle';
    protected static ?string $navigationLabel = 'سوالات متداول';
    protected static ?string $navigationGroup = 'محتوا وبسایت';
    protected static ?string $modelLabel = 'سوال متداول';
    protected static ?string $pluralModelLabel = 'سوالات متداول';
    protected static ?string $recordTitleAttribute = 'question';

    public static function getGloballySearchableAttributes(): array
    {
        return ['question'];
    }

    public static function canViewAny(): bool
    {
        return auth()->user()?->can('view faq');
    }

    public static function canCreate(): bool
    {
        return auth()->user()?->can('create faq');
    }

    public static function canEdit($record): bool
    {
        return auth()->user()?->can('edit faq');
    }

    public static function canDelete($record): bool
    {
        return auth()->user()?->can('delete faq');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('اطلاعات سوال متداول')
                    ->schema([
                        Forms\Components\TextInput::make('question')
                            ->label('سوال')
                            ->helperText('متن سوال متداول را وارد کنید')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\RichEditor::make('answer')
                            ->label('پاسخ')
                            ->helperText('پاسخ مربوط به سوال را وارد کنید')
                            ->required()
                            ->columnSpanFull(),

                        Forms\Components\TextInput::make('order')
                            ->label('ترتیب نمایش')
                            ->helperText('شماره ترتیب نمایش سوال در لیست')
                            ->required()
                            ->numeric(),

                        Forms\Components\Toggle::make('status')
                            ->label('وضعیت')
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
                Tables\Columns\TextColumn::make('question')
                    ->label('سوال')
                    ->searchable(),
                Tables\Columns\ToggleColumn::make('status')
                    ->label('وضعیت')
                    ->sortable()
                    ->onColor('success')
                    ->offColor('danger')
                    ->onIcon('heroicon-o-check')
                    ->offIcon('heroicon-o-x-mark'),
                Tables\Columns\TextColumn::make('order')
                    ->label('ترتیب نمایش')
                    ->numeric()
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
                    ->label('ایجاد سوال متداول جدید'),
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
            'index' => Pages\ListFaqs::route('/'),
            'create' => Pages\CreateFaq::route('/create'),
            'view' => Pages\ViewFaq::route('/{record}'),
            'edit' => Pages\EditFaq::route('/{record}/edit'),
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
