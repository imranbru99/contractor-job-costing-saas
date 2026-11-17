<?php

namespace App\Filament\Resources\LaborEntries\Pages;

use App\Filament\Resources\LaborEntries\LaborEntryResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListLaborEntries extends ListRecords
{
    protected static string $resource = LaborEntryResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}