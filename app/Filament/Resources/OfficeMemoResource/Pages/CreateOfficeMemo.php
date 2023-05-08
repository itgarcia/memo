<?php

namespace App\Filament\Resources\OfficeMemoResource\Pages;

use App\Filament\Resources\OfficeMemoResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateOfficeMemo extends CreateRecord
{
    protected static string $resource = OfficeMemoResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
