<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InsurancePolicyResource\Pages;
use App\Filament\Resources\InsurancePolicyResource\RelationManagers;
use App\Models\InsurancePolicy;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class InsurancePolicyResource extends Resource
{
    protected static ?string $model = InsurancePolicy::class;

    protected static ?string $navigationIcon = 'heroicon-o-shield-check';
    protected static ?string $navigationLabel = 'بیمه‌نامه‌ها';
    protected static ?string $navigationGroup = 'مدیریت بیمه‌نامه‌ها';
    protected static ?string $modelLabel = 'بیمه‌نامه';
    protected static ?string $pluralModelLabel = 'بیمه‌نامه‌ها';
    protected static ?string $recordTitleAttribute = 'insurance_policies_number';

    public static function getGloballySearchableAttributes(): array
    {
        return ['insurance_policies_number' , 'user.email','amount_of_each_installment'];
    }

    public static function canViewAny(): bool
    {
        return auth()->user()?->can('view insurance policy');
    }

    public static function canCreate(): bool
    {
        return auth()->user()?->can('create insurance policy');
    }

    public static function canEdit($record): bool
    {
        return auth()->user()?->can('edit insurance policy');
    }

    public static function canDelete($record): bool
    {
        return auth()->user()?->can('delete insurance policy');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('اطلاعات بیمه‌نامه')
                    ->schema([
                        Forms\Components\Select::make('user_id')
                            ->label('کاربر')
                            ->helperText('کاربر مربوط به بیمه‌نامه را انتخاب کنید')
                            ->relationship('user', 'email')
                            ->searchable()
                            ->preload()
                            ->required(),
                        Forms\Components\TextInput::make('insurance_policies_number')
                            ->label('شماره بیمه‌نامه')
                            ->helperText('شماره بیمه‌نامه را وارد کنید')
                            ->required()
                            ->hint('**لطفا با دقت وارد شود**')
                            ->hintColor('danger'),
                        Forms\Components\DatePicker::make('date_of_issue')
                            ->label('تاریخ صدور')
                            ->helperText('تاریخ صدور بیمه‌نامه را انتخاب کنید')
                            ->required(),
                        Forms\Components\Select::make('type_insurance_policies')
                            ->label('نوع بیمه‌نامه')
                            ->options(InsurancePolicy::TYPE_INSURANCE_POLICIES)
                            ->native(false)
                            ->helperText('نوع بیمه‌نامه را انتخاب کنید')
                            ->required(),

                        Forms\Components\Select::make('installment_type')
                            ->label('نوع قسط')
                            ->options(InsurancePolicy::INSTALLMENT_TYPES)
                            ->helperText('نوع قسط را وارد کنید')
                            ->native(false)
                            ->required()
                            ->reactive(),

                        Forms\Components\TextInput::make('amount_of_each_installment')
                            ->label('مبلغ هر قسط')
                            ->helperText('مبلغ هر قسط را وارد کنید')
                            ->required()
                            ->numeric()
                            ->prefixIcon('heroicon-o-currency-dollar')
                            ->visible(fn ($get) => filled($get('installment_type'))),

                        Forms\Components\Select::make('status')
                            ->label('وضعیت')
                            ->options(InsurancePolicy::STATUS_OPTIONS)
                            ->helperText('وضعیت بیمه‌نامه را انتخاب کنید')
                            ->native(false)
                            ->required(),

                        Forms\Components\Select::make('un_paid')
                            ->label('وضعیت پرداخت بیمه نامه')
                            ->helperText('وضعیت پرداخت بیمه‌نامه را انتخاب کنید')
                            ->native(false)
                            ->options([
                                'true'  => 'پرداخت نشده!',
                                'false' => 'پرداخت شده'
                            ])
                            ->required(),

                        Forms\Components\FileUpload::make('images')
                            ->label('تصاویر بیمه‌نامه')
                            ->helperText('تصاویر مربوط به بیمه‌نامه را بارگذاری کنید')
                            ->required()
                            ->multiple()
                            ->image()
                            ->reorderable()
                            ->openable()
                            ->downloadable()
                            ->imageEditor()
                            ->directory('uploads/images/insurance/images')
                            ->columnSpanFull()
                            // Store as JSON string to avoid array-to-string error
                            ->dehydrateStateUsing(fn ($state) => $state ? json_encode($state) : null)
                            ->formatStateUsing(fn ($state) => $state ? json_decode($state, true) : []),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.email')
                    ->label('ایمیل کاربر')
                    ->sortable()
                    ->searchable()
                    ->placeholder('بدون کاربر'),

                Tables\Columns\TextColumn::make('insurance_policies_number')
                    ->label('شماره بیمه‌نامه')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('date_of_issue')
                    ->label('تاریخ صدور')
                    ->date('Y/m/d')
                    ->sortable(),

                Tables\Columns\TextColumn::make('type_insurance_policies')
                    ->label('نوع بیمه‌نامه')
                    ->formatStateUsing(fn ($state) => \App\Models\InsurancePolicy::TYPE_INSURANCE_POLICIES[$state] ?? '-')
                    ->sortable(),

                Tables\Columns\TextColumn::make('installment_type')
                    ->label('نوع قسط')
                    ->formatStateUsing(fn ($state) => \App\Models\InsurancePolicy::INSTALLMENT_TYPES[$state] ?? '-')
                    ->sortable(),

                Tables\Columns\TextColumn::make('amount_of_each_installment')
                    ->label('مبلغ هر قسط')
                    ->numeric()
                    ->sortable(),

                Tables\Columns\SelectColumn::make('status')
                    ->label('وضعیت')
                    ->options(InsurancePolicy::STATUS_OPTIONS)
                    ->disablePlaceholderSelection()
                    ->sortable(),
                Tables\Columns\SelectColumn::make('un_paid')
                    ->label('وضعیت پرداخت بیمه نامه')
                    ->disablePlaceholderSelection()
                    ->options([
                        'true'  => 'پرداخت نشده!',
                        'false' => 'پرداخت شده'
                    ]),

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
                    ->label('ایجاد بیمه نامه جدید'),
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
            'index' => Pages\ListInsurancePolicies::route('/'),
            'create' => Pages\CreateInsurancePolicy::route('/create'),
            'view' => Pages\ViewInsurancePolicy::route('/{record}'),
            'edit' => Pages\EditInsurancePolicy::route('/{record}/edit'),
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
