<?php

namespace App\Filament\Resources\ChangeOrders\Pages;

use App\Filament\Resources\ChangeOrders\ChangeOrderResource;
use Filament\Resources\Pages\CreateRecord;

class CreateChangeOrder extends CreateRecord
{
    protected static string $resource = ChangeOrderResource::class;
}