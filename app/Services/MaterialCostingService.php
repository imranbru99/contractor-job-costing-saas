<?php

namespace App\Services;

use App\Models\MaterialCost;
use App\Models\Project;

class MaterialCostingService
{
    public function __construct(private MarginService $margins) {}

    public function issue(Project $project, array $data): MaterialCost
    {
        $qty = (float) ($data['quantity'] ?? 0);
        $unit = (float) ($data['unit_cost'] ?? 0);
        $waste = (float) ($data['waste_pct'] ?? 0);
        $total = round($qty * $unit * (1 + ($waste / 100)), 2);

        $cost = MaterialCost::query()->create([
            ...$data,
            'project_id' => $project->id,
            'total_cost' => $total,
        ]);

        $this->margins->recalculate($project->fresh());

        return $cost;
    }
}