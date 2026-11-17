<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LaborEntry extends Model
{
    protected $fillable = [
        'project_id', 'user_id', 'work_date', 'crew_role', 'hours',
        'hourly_rate', 'burden_rate', 'total_cost', 'cost_code', 'notes',
    ];

    protected function casts(): array
    {
        return [
            'work_date' => 'date',
            'hours' => 'decimal:2',
            'hourly_rate' => 'decimal:2',
            'burden_rate' => 'decimal:2',
            'total_cost' => 'decimal:2',
        ];
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}