<?php

namespace App\Filament\Resources\ChangeOrders\Pages;

use App\Filament\Resources\ChangeOrders\ChangeOrderResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditChangeOrder extends EditRecord
{
    protected static string $resource = ChangeOrderResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}