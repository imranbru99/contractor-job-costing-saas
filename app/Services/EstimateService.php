<?php

namespace App\Services;

use App\Models\Estimate;
use App\Models\Project;
use App\Models\User;
use Illuminate\Support\Str;

class EstimateService
{
    public function build(array $data, ?User $creator = null): Estimate
    {
        $labor = (float) ($data['labor_total'] ?? 0);
        $materials = (float) ($data['materials_total'] ?? 0);
        $other = (float) ($data['other_total'] ?? 0);
        $contingency = (float) ($data['contingency_pct'] ?? 5);
        $markup = (float) ($data['markup_pct'] ?? 12);
        $sub = $labor + $materials + $other;
        $withContingency = $sub * (1 + ($contingency / 100));
        $bid = round($withContingency * (1 + ($markup / 100)), 2);

        return Estimate::query()->create([
            ...$data,
            'number' => $data['number'] ?? ('EST-'.strtoupper(Str::random(6))),
            'bid_total' => $bid,
            'created_by' => $creator?->id,
        ]);
    }

    public function convertToProject(Estimate $estimate, User $manager): Project
    {
        $slug = Str::slug($estimate->title).'-'.Str::lower(Str::random(4));

        $project = Project::query()->create([
            'code' => 'JOB-'.strtoupper(Str::random(5)),
            'name' => $estimate->title,
            'slug' => $slug,
            'manager_id' => $manager->id,
            'status' => 'active',
            'contract_value' => $estimate->bid_total,
            'budget_labor' => $estimate->labor_total,
            'budget_materials' => $estimate->materials_total,
            'budget_other' => $estimate->other_total,
            'contingency_pct' => $estimate->contingency_pct,
            'start_date' => now()->toDateString(),
        ]);

        $estimate->update(['project_id' => $project->id, 'status' => 'won']);

        return $project;
    }
}