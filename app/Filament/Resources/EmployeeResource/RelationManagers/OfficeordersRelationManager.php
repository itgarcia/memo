<?php

namespace App\Filament\Resources\EmployeeResource\RelationManagers;

use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OfficeordersRelationManager extends RelationManager
{
    protected static string $relationship = 'officeorders';

    protected static ?string $recordTitleAttribute = 'no_memo';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('no_memo')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('no_memo')->label('Office Order No.'),
                Tables\Columns\TextColumn::make('title')->label('Title')
                ->size('sm')
                ->wrap(),
            ])
            ->filters([
                //
            ])
            ->headerActions([

                Tables\Actions\AttachAction::make(),
            ])
            ->actions([

                Tables\Actions\DetachAction::make(),
   
            ])
            ->bulkActions([
                Tables\Actions\DetachBulkAction::make(),
            ]);
    }    
}
