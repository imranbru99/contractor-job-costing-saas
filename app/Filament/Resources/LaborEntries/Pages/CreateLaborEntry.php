<?php

namespace App\Filament\Resources\LaborEntries\Pages;

use App\Filament\Resources\LaborEntries\LaborEntryResource;
use Filament\Resources\Pages\CreateRecord;

class CreateLaborEntry extends CreateRecord
{
    protected static string $resource = LaborEntryResource::class;
}