<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MaterialCost extends Model
{
    protected $fillable = [
        'project_id', 'vendor_id', 'item_name', 'sku', 'quantity', 'unit',
        'unit_cost', 'waste_pct', 'total_cost', 'cost_code', 'issued_at', 'notes',
    ];

    protected function casts(): array
    {
        return [
            'quantity' => 'decimal:3',
            'unit_cost' => 'decimal:2',
            'waste_pct' => 'decimal:2',
            'total_cost' => 'decimal:2',
            'issued_at' => 'date',
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