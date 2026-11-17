<?php

namespace App\Filament\Resources\CostInsights;

use App\Filament\Resources\CostInsights\Pages\CreateCostInsight;
use App\Filament\Resources\CostInsights\Pages\EditCostInsight;
use App\Filament\Resources\CostInsights\Pages\ListCostInsights;
use App\Filament\Resources\CostInsights\Schemas\CostInsightForm;
use App\Filament\Resources\CostInsights\Tables\CostInsightsTable;
use App\Models\CostInsight;
use App\Services\ModuleManager;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class CostInsightResource extends Resource
{
    protected static ?string $model = CostInsight::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedSparkles;

    protected static string|UnitEnum|null $navigationGroup = 'AI Insights';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationLabel = 'Cost Insights';

    public static function shouldRegisterNavigation(): bool
    {
        return app(ModuleManager::class)->enabled('ai_cost_insights');
    }

    public static function canAccess(): bool
    {
        return static::shouldRegisterNavigation();
    }

    public static function form(Schema $schema): Schema
    {
        return CostInsightForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CostInsightsTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListCostInsights::route('/'),
            'create' => CreateCostInsight::route('/create'),
            'edit' => EditCostInsight::route('/{record}/edit'),
        ];
    }
}