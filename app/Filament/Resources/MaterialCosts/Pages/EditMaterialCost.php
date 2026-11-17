<?php

namespace App\Filament\Resources\MaterialCosts\Pages;

use App\Filament\Resources\MaterialCosts\MaterialCostResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditMaterialCost extends EditRecord
{
    protected static string $resource = MaterialCostResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}