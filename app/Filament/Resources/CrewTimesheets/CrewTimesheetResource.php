<?php

namespace App\Filament\Resources\CrewTimesheets;

use App\Filament\Resources\CrewTimesheets\Pages\CreateCrewTimesheet;
use App\Filament\Resources\CrewTimesheets\Pages\EditCrewTimesheet;
use App\Filament\Resources\CrewTimesheets\Pages\ListCrewTimesheets;
use App\Filament\Resources\CrewTimesheets\Schemas\CrewTimesheetForm;
use App\Filament\Resources\CrewTimesheets\Tables\CrewTimesheetsTable;
use App\Models\CrewTimesheet;
use App\Services\ModuleManager;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class CrewTimesheetResource extends Resource
{
    protected static ?string $model = CrewTimesheet::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedClipboardDocumentCheck;

    protected static string|UnitEnum|null $navigationGroup = 'Labor & Crew';

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationLabel = 'Timesheets';

    public static function shouldRegisterNavigation(): bool
    {
        return app(ModuleManager::class)->enabled('crew_timesheets');
    }

    public static function canAccess(): bool
    {
        return static::shouldRegisterNavigation();
    }

    public static function form(Schema $schema): Schema
    {
        return CrewTimesheetForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CrewTimesheetsTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListCrewTimesheets::route('/'),
            'create' => CreateCrewTimesheet::route('/create'),
            'edit' => EditCrewTimesheet::route('/{record}/edit'),
        ];
    }
}