<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\ModuleSetting;
use App\Models\Project;
use App\Models\User;
use App\Models\Vendor;
use App\Services\AiCostInsightService;
use App\Services\ChangeOrderService;
use App\Services\EstimateService;
use App\Services\LaborCostingService;
use App\Services\MarginService;
use App\Services\MaterialCostingService;
use App\Services\PurchaseOrderService;
use App\Services\TimesheetService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DemoSeeder extends Seeder
{
    public function run(): void
    {
        foreach (config('modules') as $key => $module) {
            ModuleSetting::query()->updateOrCreate(
                ['key' => $key],
                ['enabled' => (bool) ($module['enabled'] ?? true), 'meta' => ['label' => $module['label'] ?? $key]]
            );
        }

        $super = User::query()->updateOrCreate(
            ['email' => 'superadmin@forgecost.test'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('password'),
                'role' => UserRole::SuperAdmin,
                'title' => 'Operations Director',
                'is_active' => true,
            ]
        );

        User::query()->updateOrCreate(
            ['email' => 'admin@forgecost.test'],
            [
                'name' => 'Construction Admin',
                'password' => Hash::make('password'),
                'role' => UserRole::Admin,
                'title' => 'Office Administrator',
                'is_active' => true,
            ]
        );

        $manager = User::query()->updateOrCreate(
            ['email' => 'manager@forgecost.test'],
            [
                'name' => 'Project Manager',
                'password' => Hash::make('password'),
                'role' => UserRole::Manager,
                'title' => 'Senior PM',
                'is_active' => true,
            ]
        );

        $staff = User::query()->updateOrCreate(
            ['email' => 'staff@forgecost.test'],
            [
                'name' => 'Field Foreman',
                'password' => Hash::make('password'),
                'role' => UserRole::Staff,
                'title' => 'Foreman',
                'is_active' => true,
            ]
        );

        User::query()->updateOrCreate(
            ['email' => 'demo@forgecost.test'],
            [
                'name' => 'Demo User',
                'password' => Hash::make('password'),
                'role' => UserRole::Demo,
                'title' => 'Demo Estimator',
                'is_demo' => true,
                'is_active' => true,
            ]
        );

        $client = User::query()->updateOrCreate(
            ['email' => 'client@forgecost.test'],
            [
                'name' => 'Owner Rep',
                'password' => Hash::make('password'),
                'role' => UserRole::Client,
                'title' => 'Client Portal',
                'is_active' => true,
            ]
        );

        $lumber = Vendor::query()->updateOrCreate(
            ['slug' => 'ridgeway-lumber'],
            [
                'name' => 'Ridgeway Lumber',
                'email' => 'orders@ridgeway.test',
                'phone' => '+1-555-0142',
                'category' => 'Materials',
                'payment_terms' => 'Net 30',
                'address' => '88 Mill Rd, Austin, TX',
                'status' => 'active',
            ]
        );

        $steel = Vendor::query()->updateOrCreate(
            ['slug' => 'metro-steel-supply'],
            [
                'name' => 'Metro Steel Supply',
                'email' => 'sales@metrosteel.test',
                'category' => 'Structural',
                'payment_terms' => 'Net 15',
                'status' => 'active',
            ]
        );

        $estimateService = app(EstimateService::class);
        $labor = app(LaborCostingService::class);
        $materials = app(MaterialCostingService::class);
        $coService = app(ChangeOrderService::class);
        $timesheets = app(TimesheetService::class);
        $pos = app(PurchaseOrderService::class);
        $margins = app(MarginService::class);
        $ai = app(AiCostInsightService::class);

        $estimate = $estimateService->build([
            'title' => 'Riverside Medical TI Fit-Out',
            'status' => 'submitted',
            'labor_total' => 185000,
            'materials_total' => 142000,
            'other_total' => 28000,
            'contingency_pct' => 6,
            'markup_pct' => 14,
            'valid_until' => now()->addDays(21)->toDateString(),
        ], $manager);

        $project = $estimateService->convertToProject($estimate, $manager);
        $project->update([
            'client_name' => 'Riverside Health Group',
            'client_user_id' => $client->id,
            'location' => 'Austin, TX',
            'end_date' => now()->addMonths(5)->toDateString(),
            'notes' => 'Interior renovation with phased occupancy.',
        ]);

        $projectB = Project::query()->updateOrCreate(
            ['code' => 'JOB-BRIDGE01'],
            [
                'name' => 'Cedar Bridge Deck Replacement',
                'slug' => 'cedar-bridge-deck',
                'client_name' => 'County Public Works',
                'manager_id' => $manager->id,
                'status' => 'active',
                'contract_value' => 420000,
                'budget_labor' => 160000,
                'budget_materials' => 175000,
                'budget_other' => 25000,
                'contingency_pct' => 5,
                'start_date' => now()->subWeeks(3)->toDateString(),
                'location' => 'Travis County, TX',
            ]
        );

        $labor->record($project, [
            'user_id' => $staff->id,
            'work_date' => now()->subDays(2)->toDateString(),
            'crew_role' => 'Carpenter',
            'hours' => 8,
            'hourly_rate' => 38,
            'burden_rate' => 16,
            'cost_code' => 'LAB-06',
        ]);

        $labor->record($project, [
            'user_id' => $staff->id,
            'work_date' => now()->subDay()->toDateString(),
            'crew_role' => 'Electrician',
            'hours' => 9,
            'hourly_rate' => 46,
            'burden_rate' => 18,
            'cost_code' => 'LAB-16',
        ]);

        $materials->issue($project, [
            'vendor_id' => $lumber->id,
            'item_name' => 'Fire-rated drywall 5/8"',
            'sku' => 'DW-FR-58',
            'quantity' => 420,
            'unit' => 'sheet',
            'unit_cost' => 18.5,
            'waste_pct' => 7,
            'cost_code' => 'MAT-09',
            'issued_at' => now()->subDays(3)->toDateString(),
        ]);

        $materials->issue($projectB, [
            'vendor_id' => $steel->id,
            'item_name' => 'Galvanized decking panels',
            'sku' => 'STL-DK-12',
            'quantity' => 86,
            'unit' => 'ea',
            'unit_cost' => 312,
            'waste_pct' => 3,
            'cost_code' => 'MAT-05',
            'issued_at' => now()->subDays(5)->toDateString(),
        ]);

        $co = $coService->create($project, [
            'number' => 'CO-001',
            'title' => 'Add nurse station millwork',
            'description' => 'Owner requested custom millwork package.',
            'status' => 'pending',
            'amount' => 18500,
            'cost_impact' => 12100,
        ]);
        $coService->approve($co, $super);

        $coService->create($projectB, [
            'number' => 'CO-001',
            'title' => 'Additional abutment waterproofing',
            'status' => 'pending',
            'amount' => 24000,
            'cost_impact' => 16800,
        ]);

        $timesheets->submit($project, $staff, [
            'work_date' => now()->toDateString(),
            'clock_in' => '06:45',
            'clock_out' => '15:15',
            'hours' => 8,
            'crew_role' => 'Foreman',
            'hourly_rate' => 48,
            'burden_rate' => 20,
            'source' => 'attendance_hub',
        ], false);

        $po = $pos->issue($project, $lumber, [
            'subtotal' => 9200,
            'tax' => 736,
            'expected_at' => now()->addDays(4)->toDateString(),
        ]);
        $pos->receive($po, 5000);

        $pos->issue($projectB, $steel, [
            'subtotal' => 41000,
            'tax' => 3280,
            'status' => 'issued',
            'expected_at' => now()->addDays(10)->toDateString(),
        ]);

        $margins->recalculate($project->fresh());
        $margins->recalculate($projectB->fresh());
        $ai->analyze($project->fresh());
        $ai->analyze($projectB->fresh());

        $estimateService->build([
            'title' => 'Westlake Retail Shell Bid',
            'status' => 'draft',
            'labor_total' => 96000,
            'materials_total' => 88000,
            'other_total' => 12000,
            'contingency_pct' => 5,
            'markup_pct' => 11,
            'valid_until' => now()->addDays(14)->toDateString(),
        ], $manager);
    }
}