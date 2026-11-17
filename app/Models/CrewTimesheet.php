<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CrewTimesheet extends Model
{
    protected $fillable = [
        'project_id', 'user_id', 'work_date', 'clock_in', 'clock_out',
        'hours', 'break_minutes', 'status', 'source', 'notes',
    ];

    protected function casts(): array
    {
        return [
            'work_date' => 'date',
            'hours' => 'decimal:2',
            'break_minutes' => 'integer',
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