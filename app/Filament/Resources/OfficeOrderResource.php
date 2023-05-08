<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OfficeOrderResource\Pages;
use Filament\Tables\Actions\Action;
use App\Filament\Resources\OfficeOrderResource\RelationManagers;
use App\Filament\Resources\OfficeOrderResource\RelationManagers\EmployeesRelationManager;
use App\Models\OfficeOrder;
use App\Models\Signatories;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\IconColumn;
use Filament\Forms\Components\Select;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\Layout;
use App\Http\Controllers\downloadController;
use Filament\Tables\Actions\RecordCheckboxPosition;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use pxlrbt\FilamentExcel\Actions\Tables\ExportAction;
use pxlrbt\FilamentExcel\Exports\ExcelExport;

class OfficeOrderResource extends Resource
{
    protected static ?string $model = OfficeOrder::class;
    
    protected static ?string $recordTitleAttribute = 'title';

    protected static ?string $navigationGroup = 'NEA Memoranda';
    protected static ?string $navigationLabel = 'Office Order';
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Card::make()->schema([
                DatePicker::make('date_memo')->required(),

                TextInput::make('no_memo')
                ->label('Document Number')
                ->required(),
    
                Textarea::make('title')
                ->rows(3)
                ->cols(20)->required(),
    
                Select::make('signatory')
                ->label('Signatory')
                ->options(Signatories::all()->pluck('fullname','fullname'))
                ->searchable()->required(),
    
                DateTimePicker::make('date_posted')->required(),
                FileUpload::make('upload')
                ->preserveFilenames()
                ->acceptedFileTypes(['application/pdf'])
                ->minSize(1)
                ->maxSize(2024)
                ->required(),
            ])->columns(2)
       
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            Tables\Columns\TextColumn::make('date_memo')->sortable()->date('m-d-Y')->size('sm')->label('Date'),
            Tables\Columns\TextColumn::make('title')->sortable()->searchable()
            ->size('sm')->wrap()
            ->description(fn (OfficeOrder $record): string => $record->no_memo, position: 'above')
            ->description(fn (OfficeOrder $record): string => $record->signatory, position: 'below'),
            Tables\Columns\TextColumn::make('date_posted')->sortable()->dateTime()->size('sm'),
            
           
                         //
        ])
            ->filters([
              
            ])
            ->actions([
                Tables\Actions\EditAction::make()->button(), 
                Action::make('download')
                ->color('success')
                ->icon('heroicon-s-download')
                ->button()
                ->url(fn (OfficeOrder $record): string => route('download', ['id' => $record]), shouldOpenInNewTab: true),
            ])
            ->bulkActions([
                ExportBulkAction::make()->exports([
                    ExcelExport::make('form')->fromForm()
                    ->askForFilename(),
                ]),
            ]);
    }
    
    public static function getRelations(): array
    {
        return [
            EmployeesRelationManager::class,
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOfficeOrders::route('/'),
            'create' => Pages\CreateOfficeOrder::route('/create'),
            'edit' => Pages\EditOfficeOrder::route('/{record}/edit'),
        ];
    }    
}
