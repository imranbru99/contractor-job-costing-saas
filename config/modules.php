<?php

return [
    'labor' => [
        'enabled' => env('MODULE_LABOR', true),
        'label' => 'Labor Costing',
        'description' => 'Track crew labor hours, burden rates, and job-coded wage costs in real time.',
    ],
    'materials' => [
        'enabled' => env('MODULE_MATERIALS', true),
        'label' => 'Materials',
        'description' => 'Capture material issues, unit costs, waste factors, and job-site allocations.',
    ],
    'change_orders' => [
        'enabled' => env('MODULE_CHANGE_ORDERS', true),
        'label' => 'Change Orders',
        'description' => 'Manage approved, pending, and rejected change orders with margin impact.',
    ],
    'margins' => [
        'enabled' => env('MODULE_MARGINS', true),
        'label' => 'Project Margins',
        'description' => 'Live contract vs cost vs projected profit dashboards for every job.',
    ],
    'estimates' => [
        'enabled' => env('MODULE_ESTIMATES', true),
        'label' => 'Estimates',
        'description' => 'Bid estimates, takeoffs, contingency, and convert wins into live jobs.',
    ],
    'crew_timesheets' => [
        'enabled' => env('MODULE_CREW_TIMESHEETS', true),
        'label' => 'Crew Timesheets',
        'description' => 'Daily crew timesheets with attendance-hub ready punch integration.',
    ],
    'vendor_pos' => [
        'enabled' => env('MODULE_VENDOR_POS', true),
        'label' => 'Vendor POs',
        'description' => 'Purchase orders to vendors with received costs rolled into job ledgers.',
    ],
    'ai_cost_insights' => [
        'enabled' => env('MODULE_AI_COST_INSIGHTS', true),
        'label' => 'AI Cost Insights',
        'description' => 'AI variance alerts, overruns, and margin recovery recommendations.',
    ],
];