<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ChangeOrder extends Model
{
    protected $fillable = [
        'project_id', 'number', 'title', 'description', 'status',
        'amount', 'cost_impact', 'margin_impact', 'requested_at',
        'approved_at', 'approved_by',
    ];

    protected function casts(): array
    {
        return [
            'amount' => 'decimal:2',
            'cost_impact' => 'decimal:2',
            'margin_impact' => 'decimal:2',
            'requested_at' => 'date',
            'approved_at' => 'date',
        ];
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function approver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}