<?php

namespace App\Services;

use App\Models\ChangeOrder;
use App\Models\Project;
use App\Models\User;

class ChangeOrderService
{
    public function __construct(private MarginService $margins) {}

    public function approve(ChangeOrder $order, User $approver): ChangeOrder
    {
        $order->update([
            'status' => 'approved',
            'approved_at' => now()->toDateString(),
            'approved_by' => $approver->id,
            'margin_impact' => (float) $order->amount - (float) $order->cost_impact,
        ]);

        $this->margins->recalculate($order->project);

        return $order->fresh();
    }

    public function create(Project $project, array $data): ChangeOrder
    {
        $amount = (float) ($data['amount'] ?? 0);
        $cost = (float) ($data['cost_impact'] ?? 0);

        return ChangeOrder::query()->create([
            ...$data,
            'project_id' => $project->id,
            'margin_impact' => $amount - $cost,
            'requested_at' => $data['requested_at'] ?? now()->toDateString(),
        ]);
    }
}