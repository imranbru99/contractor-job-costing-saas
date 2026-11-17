<?php

namespace App\Services;

use App\Models\CostInsight;
use App\Models\Project;

class AiCostInsightService
{
    public function analyze(Project $project): CostInsight
    {
        $budget = (float) $project->budget_labor + (float) $project->budget_materials + (float) $project->budget_other;
        $actual = $project->totalActualCost();
        $variance = $actual - $budget;
        $severity = $variance > ($budget * 0.1) ? 'high' : ($variance > 0 ? 'medium' : 'low');

        $title = $variance > 0
            ? 'Projected cost overrun on '.$project->code
            : 'Margin healthy on '.$project->code;

        $summary = $variance > 0
            ? sprintf('Actual costs are $%s above combined budget. Labor $%s / Materials $%s.', number_format(abs($variance), 2), number_format((float) $project->actual_labor, 2), number_format((float) $project->actual_materials, 2))
            : sprintf('Job is under budget by $%s with projected margin %s%%.', number_format(abs($variance), 2), number_format((float) $project->projected_margin_pct, 1));

        $action = $variance > 0
            ? 'Review open change orders, freeze non-critical POs, and reforecast labor burden rates.'
            : 'Lock contingency drawdown rules and continue weekly margin reviews.';

        return CostInsight::query()->create([
            'project_id' => $project->id,
            'severity' => $severity,
            'category' => $variance > 0 ? 'overrun' : 'margin',
            'title' => $title,
            'summary' => $summary,
            'recommended_action' => $action,
            'estimated_impact' => abs($variance),
            'confidence' => 0.86,
            'status' => 'open',
        ]);
    }
}