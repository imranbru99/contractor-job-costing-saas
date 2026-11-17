<?php

namespace App\Services;

use App\Models\Project;
use App\Models\PurchaseOrder;
use App\Models\Vendor;
use Illuminate\Support\Str;

class PurchaseOrderService
{
    public function __construct(private MarginService $margins) {}

    public function issue(Project $project, Vendor $vendor, array $data): PurchaseOrder
    {
        $subtotal = (float) ($data['subtotal'] ?? 0);
        $tax = (float) ($data['tax'] ?? 0);

        return PurchaseOrder::query()->create([
            'project_id' => $project->id,
            'vendor_id' => $vendor->id,
            'number' => $data['number'] ?? ('PO-'.strtoupper(Str::random(6))),
            'status' => $data['status'] ?? 'issued',
            'ordered_at' => $data['ordered_at'] ?? now()->toDateString(),
            'expected_at' => $data['expected_at'] ?? null,
            'subtotal' => $subtotal,
            'tax' => $tax,
            'total' => $subtotal + $tax,
            'received_total' => $data['received_total'] ?? 0,
            'notes' => $data['notes'] ?? null,
        ]);
    }

    public function receive(PurchaseOrder $po, float $amount): PurchaseOrder
    {
        $received = min((float) $po->total, (float) $po->received_total + $amount);
        $status = $received >= (float) $po->total ? 'received' : 'partial';
        $po->update(['received_total' => $received, 'status' => $status]);
        $this->margins->recalculate($po->project);

        return $po->fresh();
    }
}