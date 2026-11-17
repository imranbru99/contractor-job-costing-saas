<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CostInsight extends Model
{
    protected $fillable = [
        'project_id', 'severity', 'category', 'title', 'summary',
        'recommended_action', 'estimated_impact', 'confidence', 'status',
    ];

    protected function casts(): array
    {
        return [
            'estimated_impact' => 'decimal:2',
            'confidence' => 'decimal:2',
        ];
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
}