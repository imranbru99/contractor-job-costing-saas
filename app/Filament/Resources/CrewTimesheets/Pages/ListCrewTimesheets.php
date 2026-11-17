<?php

namespace App\Filament\Resources\CrewTimesheets\Pages;

use App\Filament\Resources\CrewTimesheets\CrewTimesheetResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCrewTimesheets extends ListRecords
{
    protected static string $resource = CrewTimesheetResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}