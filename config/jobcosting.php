<?php

return [
    'app_name' => env('JOBCOSTING_APP_NAME', 'Contractor Job Costing SaaS'),
    'product_name' => env('JOBCOSTING_APP_NAME', 'Contractor Job Costing SaaS'),
    'brand' => env('JOBCOSTING_BRAND', 'ForgeCost'),
    'accent' => '#EA580C',
    'project_statuses' => [
        'draft' => 'Draft',
        'estimating' => 'Estimating',
        'active' => 'Active',
        'on_hold' => 'On Hold',
        'completed' => 'Completed',
        'closed' => 'Closed',
    ],
    'change_order_statuses' => [
        'draft' => 'Draft',
        'pending' => 'Pending',
        'approved' => 'Approved',
        'rejected' => 'Rejected',
        'billed' => 'Billed',
    ],
    'po_statuses' => [
        'draft' => 'Draft',
        'issued' => 'Issued',
        'partial' => 'Partially Received',
        'received' => 'Received',
        'cancelled' => 'Cancelled',
    ],
    'estimate_statuses' => [
        'draft' => 'Draft',
        'submitted' => 'Submitted',
        'won' => 'Won',
        'lost' => 'Lost',
        'expired' => 'Expired',
    ],
];