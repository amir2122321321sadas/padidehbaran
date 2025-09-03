<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ExamResource\Pages;
use App\Filament\Resources\ExamResource\RelationManagers;
use App\Models\Exam;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ExamResource extends Resource
{
    protected static ?string $model = Exam::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'آزمون ها';

    protected static ?string $navigationGroup = 'مدیریت آزمون ها';

    protected static ?string $modelLabel = 'آزمون';
    protected static ?string $pluralModelLabel = 'آزمون ها';



    public static function canViewAny(): bool
    {
        return auth()->user()?->can('view exam');
    }

    public static function canCreate(): bool
    {
        return auth()->user()?->can('create exam');
    }

    public static function canEdit($record): bool
    {
        return auth()->user()?->can('edit exam');
    }

    public static function canDelete($record): bool
    {
        return auth()->user()?->can('delete exam');
    }

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Form $form): Form
    {
        return $form

            ->schema([
                Forms\Components\Section::make('اطلاعات کاربری')
                    ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->label('نام آزمون'),
                Forms\Components\TextInput::make('time')
                    ->required()
                    ->required()
                    ->numeric()
                    ->label('مدت آزمون (دقیقه)'),
                Forms\Components\Textarea::make('description')
                    ->label('توضیحات'),
                Forms\Components\Toggle::make('status')
                    ->label('وضعیت')
                    ->helperText('فعال یا غیرفعال بودن آزمون را مشخص کنید')
                    ->required()
                    ->onColor('success')
                    ->offColor('danger')
                    ->onIcon('heroicon-o-check')
                    ->offIcon('heroicon-o-x-mark'),

                // مدیریت سوال‌ها و گزینه‌ها با Repeater
                Forms\Components\Repeater::make('questions')
                    ->label('سوال‌ها')
                    ->relationship('questions')
                    ->schema([
                        Forms\Components\TextInput::make('question')
                            ->label('متن سوال')
                            ->required(),

                        // Repeater برای گزینه‌ها
                        Forms\Components\Repeater::make('options')
                            ->label('گزینه‌ها')
                            ->relationship('options')
                            ->schema([
                                Forms\Components\TextInput::make('option')
                                    ->label('متن گزینه')
                                    ->required(),
                                Forms\Components\Toggle::make('is_correct')
                                    ->label('گزینه صحیح است؟')
                                    ->helperText('درصورتی که فعال باشد یعنی در این سوال گزینه صحیح این گزینه است')
                                    ->onColor('success')
                                    ->offColor('danger')
                                    ->onIcon('heroicon-o-check')
                                    ->offIcon('heroicon-o-x-mark')
                                    ->default(false),
                            ])
                            ->columns(2) // دو ستون: متن و صحیح
                            ->createItemButtonLabel('افزودن گزینه'),
                    ])
                    ->createItemButtonLabel('افزودن سوال'),
                    ]),
            ]);
    }
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')->label('نام آزمون')->sortable()->searchable(),
                TextColumn::make('time')->label('مدت آزمون (دقیقه)')->sortable()->searchable(),
                ToggleColumn::make('status') ->onColor('success')
                    ->offColor('danger')
                    ->onIcon('heroicon-o-check')
                    ->offIcon('heroicon-o-x-mark')->label('فعال / غیرفعال'),
                TextColumn::make('questions_count')->label('تعداد سوال‌ها')->counts('questions'),
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
                    ->label('ایجاد آزمون جدید'),
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
            'index' => Pages\ListExams::route('/'),
            'create' => Pages\CreateExam::route('/create'),
            'view' => Pages\ViewExam::route('/{record}'),
            'edit' => Pages\EditExam::route('/{record}/edit'),
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
