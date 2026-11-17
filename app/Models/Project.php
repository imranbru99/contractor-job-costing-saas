<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    protected $fillable = [
        'code', 'name', 'slug', 'client_name', 'client_user_id', 'manager_id',
        'status', 'contract_value', 'budget_labor', 'budget_materials', 'budget_other',
        'contingency_pct', 'start_date', 'end_date', 'location', 'notes',
        'actual_labor', 'actual_materials', 'actual_other', 'approved_change_orders',
        'projected_margin_pct', 'projected_profit',
    ];

    protected function casts(): array
    {
        return [
            'contract_value' => 'decimal:2',
            'budget_labor' => 'decimal:2',
            'budget_materials' => 'decimal:2',
            'budget_other' => 'decimal:2',
            'contingency_pct' => 'decimal:2',
            'actual_labor' => 'decimal:2',
            'actual_materials' => 'decimal:2',
            'actual_other' => 'decimal:2',
            'approved_change_orders' => 'decimal:2',
            'projected_margin_pct' => 'decimal:2',
            'projected_profit' => 'decimal:2',
            'start_date' => 'date',
            'end_date' => 'date',
        ];
    }

    public function manager(): BelongsTo
    {
        return $this->belongsTo(User::class, 'manager_id');
    }

    public function clientUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'client_user_id');
    }

    public function laborEntries(): HasMany
    {
        return $this->hasMany(LaborEntry::class);
    }

    public function materialCosts(): HasMany
    {
        return $this->hasMany(MaterialCost::class);
    }

    public function changeOrders(): HasMany
    {
        return $this->hasMany(ChangeOrder::class);
    }

    public function estimates(): HasMany
    {
        return $this->hasMany(Estimate::class);
    }

    public function timesheets(): HasMany
    {
        return $this->hasMany(CrewTimesheet::class);
    }

    public function purchaseOrders(): HasMany
    {
        return $this->hasMany(PurchaseOrder::class);
    }

    public function costInsights(): HasMany
    {
        return $this->hasMany(CostInsight::class);
    }

    public function revisedContractValue(): float
    {
        return (float) $this->contract_value + (float) $this->approved_change_orders;
    }

    public function totalActualCost(): float
    {
        return (float) $this->actual_labor + (float) $this->actual_materials + (float) $this->actual_other;
    }
}