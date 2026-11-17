<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Estimate extends Model
{
    protected $fillable = [
        'project_id', 'number', 'title', 'status', 'labor_total',
        'materials_total', 'other_total', 'contingency_pct', 'markup_pct',
        'bid_total', 'valid_until', 'notes', 'created_by',
    ];

    protected function casts(): array
    {
        return [
            'labor_total' => 'decimal:2',
            'materials_total' => 'decimal:2',
            'other_total' => 'decimal:2',
            'contingency_pct' => 'decimal:2',
            'markup_pct' => 'decimal:2',
            'bid_total' => 'decimal:2',
            'valid_until' => 'date',
        ];
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}