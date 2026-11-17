<?php

namespace App\Filament\Resources\LaborEntries\Pages;

use App\Filament\Resources\LaborEntries\LaborEntryResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditLaborEntry extends EditRecord
{
    protected static string $resource = LaborEntryResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}