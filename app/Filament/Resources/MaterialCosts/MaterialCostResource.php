<?php

namespace App\Filament\Resources\MaterialCosts;

use App\Filament\Resources\MaterialCosts\Pages\CreateMaterialCost;
use App\Filament\Resources\MaterialCosts\Pages\EditMaterialCost;
use App\Filament\Resources\MaterialCosts\Pages\ListMaterialCosts;
use App\Filament\Resources\MaterialCosts\Schemas\MaterialCostForm;
use App\Filament\Resources\MaterialCosts\Tables\MaterialCostsTable;
use App\Models\MaterialCost;
use App\Services\ModuleManager;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class MaterialCostResource extends Resource
{
    protected static ?string $model = MaterialCost::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static string|UnitEnum|null $navigationGroup = 'Materials & POs';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationLabel = 'Materials';

    public static function shouldRegisterNavigation(): bool
    {
        return app(ModuleManager::class)->enabled('materials');
    }

    public static function canAccess(): bool
    {
        return static::shouldRegisterNavigation();
    }

    public static function form(Schema $schema): Schema
    {
        return MaterialCostForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MaterialCostsTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListMaterialCosts::route('/'),
            'create' => CreateMaterialCost::route('/create'),
            'edit' => EditMaterialCost::route('/{record}/edit'),
        ];
    }
}