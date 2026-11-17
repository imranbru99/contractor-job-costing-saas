<?php

namespace App\Services;

use App\Models\ChangeOrder;
use App\Models\LaborEntry;
use App\Models\MaterialCost;
use App\Models\Project;
use App\Models\PurchaseOrder;

class MarginService
{
    public function recalculate(Project $project): Project
    {
        $labor = (float) LaborEntry::query()->where('project_id', $project->id)->sum('total_cost');
        $materials = (float) MaterialCost::query()->where('project_id', $project->id)->sum('total_cost');
        $poReceived = (float) PurchaseOrder::query()
            ->where('project_id', $project->id)
            ->whereIn('status', ['partial', 'received', 'issued'])
            ->sum('received_total');
        $other = max($poReceived - $materials, 0);
        $approvedCo = (float) ChangeOrder::query()
            ->where('project_id', $project->id)
            ->where('status', 'approved')
            ->sum('amount');

        $revised = (float) $project->contract_value + $approvedCo;
        $actual = $labor + $materials + $other;
        $profit = $revised - $actual;
        $margin = $revised > 0 ? round(($profit / $revised) * 100, 2) : 0;

        $project->update([
            'actual_labor' => $labor,
            'actual_materials' => $materials,
            'actual_other' => $other,
            'approved_change_orders' => $approvedCo,
            'projected_profit' => $profit,
            'projected_margin_pct' => $margin,
        ]);

        return $project->fresh();
    }
}