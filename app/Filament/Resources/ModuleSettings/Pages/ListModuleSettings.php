<?php

namespace App\Filament\Resources\ModuleSettings\Pages;

use App\Filament\Resources\ModuleSettings\ModuleSettingResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListModuleSettings extends ListRecords
{
    protected static string $resource = ModuleSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}