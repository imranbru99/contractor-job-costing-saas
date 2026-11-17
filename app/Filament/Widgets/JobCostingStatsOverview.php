<?php

namespace App\Filament\Widgets;

use App\Models\ChangeOrder;
use App\Models\CostInsight;
use App\Models\Project;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class JobCostingStatsOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $active = Project::query()->where('status', 'active')->count();
        $avgMargin = (float) Project::query()->where('status', 'active')->avg('projected_margin_pct');
        $pendingCo = ChangeOrder::query()->where('status', 'pending')->count();
        $openInsights = CostInsight::query()->where('status', 'open')->count();

        return [
            Stat::make('Active Jobs', $active)
                ->description('Live construction projects')
                ->color('primary'),
            Stat::make('Avg Margin', number_format($avgMargin, 1).'%')
                ->description('Projected profit margin')
                ->color('success'),
            Stat::make('Pending Change Orders', $pendingCo)
                ->description('Awaiting approval')
                ->color('warning'),
            Stat::make('Open AI Insights', $openInsights)
                ->description('Cost risk recommendations')
                ->color('danger'),
        ];
    }
}