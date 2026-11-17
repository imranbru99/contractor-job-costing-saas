<?php

namespace App\Services;

use App\Models\LaborEntry;
use App\Models\Project;

class LaborCostingService
{
    public function __construct(private MarginService $margins) {}

    public function record(Project $project, array $data): LaborEntry
    {
        $hours = (float) ($data['hours'] ?? 0);
        $rate = (float) ($data['hourly_rate'] ?? 0);
        $burden = (float) ($data['burden_rate'] ?? 0);
        $total = round($hours * ($rate + $burden), 2);

        $entry = LaborEntry::query()->create([
            ...$data,
            'project_id' => $project->id,
            'total_cost' => $total,
        ]);

        $this->margins->recalculate($project->fresh());

        return $entry;
    }
}