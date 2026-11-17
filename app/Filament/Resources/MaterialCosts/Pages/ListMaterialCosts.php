<?php

namespace App\Filament\Resources\MaterialCosts\Pages;

use App\Filament\Resources\MaterialCosts\MaterialCostResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListMaterialCosts extends ListRecords
{
    protected static string $resource = MaterialCostResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}