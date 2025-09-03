<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserExamResource\Pages;
use App\Filament\Resources\UserExamResource\RelationManagers;
use App\Models\UserExam;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserExamResource extends Resource
{
    protected static ?string $model = UserExam::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';
    protected static ?string $navigationLabel = 'آزمون‌های کاربران';
    protected static ?string $modelLabel = 'آزمون کاربر';
    protected static ?string $pluralModelLabel = 'آزمون‌های کاربران';
    protected static ?string $navigationGroup = 'مدیریت آزمون ها';


    protected static ?string $recordTitleAttribute = 'test_check_id';

    public static function getGloballySearchableAttributes(): array
    {
        return ['test_check_id' , 'full_name' , 'phone'];
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('اطلاعات کاربر آزمون')
                    ->schema([
                        Forms\Components\TextInput::make('full_name')
                            ->label('نام و نام خانوادگی')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('phone')
                            ->label('شماره تلفن')
                            ->tel()
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('email')
                            ->label('ایمیل')
                            ->email()
                            ->maxLength(255)
                            ->default(null),
                        Forms\Components\Select::make('exam_id')
                            ->label('آزمون')
                            ->relationship('exam', 'title')
                            ->preload()
                            ->searchable()
                            ->required(),
                        Forms\Components\TextInput::make('score')
                            ->label('نمره')
                            ->numeric()
                            ->default(null),
                        Forms\Components\Textarea::make('token')
                            ->label('توکن')
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('test_check_id')
                            ->label('شناسه تست چک')
                            ->maxLength(255)
                            ->default(null),
                    ])->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('full_name')
                    ->label('نام و نام خانوادگی')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->label('شماره تلفن')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('ایمیل')
                    ->searchable(),
                Tables\Columns\TextColumn::make('exam.title')
                    ->label('عنوان آزمون')
                    ->searchable(),
                Tables\Columns\TextColumn::make('score')
                    ->label('نمره')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('test_check_id')
                    ->label('شناسه تست چک')
                    ->searchable(),
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
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ])->label('عملیات'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make()
                    ->label('ایجاد آزمون کاربر جدید'),
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
            'index' => Pages\ListUserExams::route('/'),
            'create' => Pages\CreateUserExam::route('/create'),
            'view' => Pages\ViewUserExam::route('/{record}'),
            'edit' => Pages\EditUserExam::route('/{record}/edit'),
        ];
    }
}
