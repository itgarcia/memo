<?php

namespace App\Filament\Resources\OfficeOrderResource\Pages;

use App\Filament\Resources\OfficeOrderResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditOfficeOrder extends EditRecord
{
    protected static string $resource = OfficeOrderResource::class;

    protected function getActions(): array
    {
        return [
           
        ];
    }
}
