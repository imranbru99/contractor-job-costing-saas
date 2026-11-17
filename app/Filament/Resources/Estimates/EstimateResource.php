<?php

namespace App\Filament\Resources\Estimates;

use App\Filament\Resources\Estimates\Pages\CreateEstimate;
use App\Filament\Resources\Estimates\Pages\EditEstimate;
use App\Filament\Resources\Estimates\Pages\ListEstimates;
use App\Filament\Resources\Estimates\Schemas\EstimateForm;
use App\Filament\Resources\Estimates\Tables\EstimatesTable;
use App\Models\Estimate;
use App\Services\ModuleManager;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class EstimateResource extends Resource
{
    protected static ?string $model = Estimate::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedTableCells;

    protected static string|UnitEnum|null $navigationGroup = 'Estimating';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationLabel = 'Estimates';

    public static function shouldRegisterNavigation(): bool
    {
        return app(ModuleManager::class)->enabled('estimates');
    }

    public static function canAccess(): bool
    {
        return static::shouldRegisterNavigation();
    }

    public static function form(Schema $schema): Schema
    {
        return EstimateForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return EstimatesTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListEstimates::route('/'),
            'create' => CreateEstimate::route('/create'),
            'edit' => EditEstimate::route('/{record}/edit'),
        ];
    }
}