<?php

namespace App\Filament\Resources\CrewTimesheets\Pages;

use App\Filament\Resources\CrewTimesheets\CrewTimesheetResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditCrewTimesheet extends EditRecord
{
    protected static string $resource = CrewTimesheetResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}