<?php

namespace App\Services;

use App\Models\CrewTimesheet;
use App\Models\Project;
use App\Models\User;

class TimesheetService
{
    public function __construct(private LaborCostingService $labor) {}

    public function submit(Project $project, User $worker, array $data, bool $postLabor = true): CrewTimesheet
    {
        $sheet = CrewTimesheet::query()->create([
            'project_id' => $project->id,
            'user_id' => $worker->id,
            'work_date' => $data['work_date'] ?? now()->toDateString(),
            'clock_in' => $data['clock_in'] ?? '07:00',
            'clock_out' => $data['clock_out'] ?? '15:30',
            'hours' => $data['hours'] ?? 8,
            'break_minutes' => $data['break_minutes'] ?? 30,
            'status' => $data['status'] ?? 'submitted',
            'source' => $data['source'] ?? 'manual',
            'notes' => $data['notes'] ?? null,
        ]);

        if ($postLabor) {
            $this->labor->record($project, [
                'user_id' => $worker->id,
                'work_date' => $sheet->work_date,
                'crew_role' => $data['crew_role'] ?? 'Crew',
                'hours' => $sheet->hours,
                'hourly_rate' => $data['hourly_rate'] ?? 42,
                'burden_rate' => $data['burden_rate'] ?? 18,
                'cost_code' => $data['cost_code'] ?? 'LAB-GEN',
            ]);
        }

        return $sheet;
    }
}