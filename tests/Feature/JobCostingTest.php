<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\User;
use App\Services\LaborCostingService;
use App\Services\MarginService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class JobCostingTest extends TestCase
{
    use RefreshDatabase;

    public function test_labor_updates_project_actuals(): void
    {
        $manager = User::factory()->create();
        $project = Project::query()->create([
            'code' => 'JOB-TEST1',
            'name' => 'Test Job',
            'slug' => 'test-job',
            'manager_id' => $manager->id,
            'status' => 'active',
            'contract_value' => 100000,
            'budget_labor' => 40000,
            'budget_materials' => 30000,
            'budget_other' => 5000,
        ]);

        app(LaborCostingService::class)->record($project, [
            'user_id' => $manager->id,
            'work_date' => now()->toDateString(),
            'hours' => 10,
            'hourly_rate' => 40,
            'burden_rate' => 10,
            'crew_role' => 'Tester',
        ]);

        $fresh = $project->fresh();
        $this->assertEquals(500.0, (float) $fresh->actual_labor);
        $this->assertTrue((float) $fresh->projected_profit < 100000);
        $this->assertNotNull(app(MarginService::class)->recalculate($fresh));
    }
}