<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PurchaseOrder extends Model
{
    protected $fillable = [
        'project_id', 'vendor_id', 'number', 'status', 'ordered_at',
        'expected_at', 'subtotal', 'tax', 'total', 'received_total', 'notes',
    ];

    protected function casts(): array
    {
        return [
            'ordered_at' => 'date',
            'expected_at' => 'date',
            'subtotal' => 'decimal:2',
            'tax' => 'decimal:2',
            'total' => 'decimal:2',
            'received_total' => 'decimal:2',
        ];
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function vendor(): BelongsTo
    {
        return $this->belongsTo(Vendor::class);
    }
}