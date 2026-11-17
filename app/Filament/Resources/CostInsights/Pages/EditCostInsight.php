<?php

namespace App\Filament\Resources\CostInsights\Pages;

use App\Filament\Resources\CostInsights\CostInsightResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditCostInsight extends EditRecord
{
    protected static string $resource = CostInsightResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}