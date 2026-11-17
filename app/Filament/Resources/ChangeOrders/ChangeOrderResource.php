<?php

namespace App\Filament\Resources\ChangeOrders;

use App\Filament\Resources\ChangeOrders\Pages\CreateChangeOrder;
use App\Filament\Resources\ChangeOrders\Pages\EditChangeOrder;
use App\Filament\Resources\ChangeOrders\Pages\ListChangeOrders;
use App\Filament\Resources\ChangeOrders\Schemas\ChangeOrderForm;
use App\Filament\Resources\ChangeOrders\Tables\ChangeOrdersTable;
use App\Models\ChangeOrder;
use App\Services\ModuleManager;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class ChangeOrderResource extends Resource
{
    protected static ?string $model = ChangeOrder::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedDocumentText;

    protected static string|UnitEnum|null $navigationGroup = 'Job Costing';

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationLabel = 'Change Orders';

    public static function shouldRegisterNavigation(): bool
    {
        return app(ModuleManager::class)->enabled('change_orders');
    }

    public static function canAccess(): bool
    {
        return static::shouldRegisterNavigation();
    }

    public static function form(Schema $schema): Schema
    {
        return ChangeOrderForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ChangeOrdersTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListChangeOrders::route('/'),
            'create' => CreateChangeOrder::route('/create'),
            'edit' => EditChangeOrder::route('/{record}/edit'),
        ];
    }
}