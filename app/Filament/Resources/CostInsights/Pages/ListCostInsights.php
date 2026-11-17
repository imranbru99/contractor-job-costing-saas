<?php

namespace App\Filament\Resources\CostInsights\Pages;

use App\Filament\Resources\CostInsights\CostInsightResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCostInsights extends ListRecords
{
    protected static string $resource = CostInsightResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}