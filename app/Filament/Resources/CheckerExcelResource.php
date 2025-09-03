<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CheckerExcelResource\Pages;
use App\Filament\Resources\CheckerExcelResource\RelationManagers;
use App\Models\CheckerExcel;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ExportAction;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CheckerExcelResource extends Resource
{
    protected static ?string $model = CheckerExcel::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'بررسی کننده پرداخت نشده ها';

    protected static ?string $navigationGroup = 'مدیریت بررسی کننده پرداخت نشده ها';

    protected static ?string $modelLabel = 'بررسی کننده پرداخت نشده';
    protected static ?string $pluralModelLabel = 'بررسی کننده پرداخت نشده ها';

    protected static ?string $recordTitleAttribute = 'policy_number';


    public static function canEdit($record): bool
    {
        return auth()->user()?->can('edit checker excel');
    }

    public static function canViewAny(): bool
    {
        return auth()->user()?->can('view checker excel');
    }

    public static function canCreate(): bool
    {
        return auth()->user()?->can('create checker excel');
    }

    public static function canDelete($record): bool
    {
        return auth()->user()?->can('delete checker excel');
    }


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('policy_number')
                    ->required()
                    ->label('شماره بیمه نامه')
                    ->maxLength(255),
                Forms\Components\TextInput::make('policy_type')
                    ->required()
                    ->label('نوع بیمه نامه')
                    ->maxLength(255),
                Forms\Components\TextInput::make('contract')
                    ->maxLength(255)
                    ->label('قرارداد')
                    ->default(null),
                Forms\Components\TextInput::make('policyholder')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('policyholder_national_id')
                    ->required()
                    ->maxLength(10),
                Forms\Components\TextInput::make('policyholder_mobile')
                    ->required()
                    ->maxLength(15),
                Forms\Components\TextInput::make('insured')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('currency_unit')
                    ->required()
                    ->maxLength(10),
                Forms\Components\DatePicker::make('issue_date')
                    ->required(),
                Forms\Components\DatePicker::make('start_date')
                    ->required(),
                Forms\Components\DatePicker::make('end_date')
                    ->required(),
                Forms\Components\TextInput::make('issuing_unit')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('issuing_unit_code')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('issuing_province')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('issuing_city')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('issuing_supervisor')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('issuing_supervisor_code')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('introducer')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('introducer_code')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('sales_org_code')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('sales_org_introducers')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('year_number')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('installment_number')
                    ->required()
                    ->numeric(),
                Forms\Components\DatePicker::make('installment_due_date')
                    ->required(),
                Forms\Components\TextInput::make('installment_amount')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('installment_balance')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('life_insurance_premium')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('supplementary_insurance_premium')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('savings_amount')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('sales_cost')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('collection_cost')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('supplementary_commission')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('administrative_cost')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('insurance_cost')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('deposit_commission')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('deposit_profit')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('identifier_code')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('payment_identifier')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('policy_number')
                    ->searchable(),
                Tables\Columns\TextColumn::make('policy_type')
                    ->searchable(),
                Tables\Columns\TextColumn::make('contract')
                    ->searchable(),
                Tables\Columns\TextColumn::make('policyholder')
                    ->searchable(),
                Tables\Columns\TextColumn::make('policyholder_national_id')
                    ->searchable(),
                Tables\Columns\TextColumn::make('policyholder_mobile')
                    ->searchable(),
                Tables\Columns\TextColumn::make('insured')
                    ->searchable(),
                Tables\Columns\TextColumn::make('currency_unit')
                    ->searchable(),
                Tables\Columns\TextColumn::make('issue_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('start_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('end_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('issuing_unit')
                    ->searchable(),
                Tables\Columns\TextColumn::make('issuing_unit_code')
                    ->searchable(),
                Tables\Columns\TextColumn::make('issuing_province')
                    ->searchable(),
                Tables\Columns\TextColumn::make('issuing_city')
                    ->searchable(),
                Tables\Columns\TextColumn::make('issuing_supervisor')
                    ->searchable(),
                Tables\Columns\TextColumn::make('issuing_supervisor_code')
                    ->searchable(),
                Tables\Columns\TextColumn::make('introducer')
                    ->searchable(),
                Tables\Columns\TextColumn::make('introducer_code')
                    ->searchable(),
                Tables\Columns\TextColumn::make('sales_org_code')
                    ->searchable(),
                Tables\Columns\TextColumn::make('sales_org_introducers')
                    ->searchable(),
                Tables\Columns\TextColumn::make('year_number')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('installment_number')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('installment_due_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('installment_amount')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('installment_balance')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('life_insurance_premium')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('supplementary_insurance_premium')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('savings_amount')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('sales_cost')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('collection_cost')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('supplementary_commission')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('administrative_cost')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('insurance_cost')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('deposit_commission')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('deposit_profit')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('identifier_code')
                    ->searchable(),
                Tables\Columns\TextColumn::make('payment_identifier')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])

            ->headerActions([

                Action::make('importExcel')
                    ->label('ایمپورت اکسل')
                    ->form([
                        Forms\Components\FileUpload::make('file')
                            ->label('آپلود فایل اکسل')
                            ->directory('imports/CheckerExcel') // فایل‌ها داخل storage/app/public/imports ذخیره میشن
                            ->acceptedFileTypes([
                                'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                                'application/vnd.ms-excel',
                            ])
                            ->required(),
                    ])
                    ->action(function (array $data) {
                        try {
                            // مسیر کامل فایل روی سرور
                            $filePath = storage_path('app/public/' . $data['file']);

                            \Maatwebsite\Excel\Facades\Excel::import(
                                new \App\Imports\CheckerExcelImport,
                                $filePath
                            );

                            Notification::make()
                                ->title('با موفقیت اکسل وارد شد ✅')
                                ->success()
                                ->send();

                        } catch (\Exception $e) {
                            Notification::make()
                                ->title('مشکلی پیش آمده: ' . $e->getMessage())
                                ->danger()
                                ->send();
                        }
                    }),


            ])

            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
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
            'index' => Pages\ListCheckerExcels::route('/'),
            'create' => Pages\CreateCheckerExcel::route('/create'),
            'view' => Pages\ViewCheckerExcel::route('/{record}'),
            'edit' => Pages\EditCheckerExcel::route('/{record}/edit'),
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
