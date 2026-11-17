<?php

namespace App\Filament\Resources\LaborEntries;

use App\Filament\Resources\LaborEntries\Pages\CreateLaborEntry;
use App\Filament\Resources\LaborEntries\Pages\EditLaborEntry;
use App\Filament\Resources\LaborEntries\Pages\ListLaborEntries;
use App\Filament\Resources\LaborEntries\Schemas\LaborEntryForm;
use App\Filament\Resources\LaborEntries\Tables\LaborEntriesTable;
use App\Models\LaborEntry;
use App\Services\ModuleManager;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class LaborEntryResource extends Resource
{
    protected static ?string $model = LaborEntry::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedClock;

    protected static string|UnitEnum|null $navigationGroup = 'Labor & Crew';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationLabel = 'Labor Entries';

    public static function shouldRegisterNavigation(): bool
    {
        return app(ModuleManager::class)->enabled('labor');
    }

    public static function canAccess(): bool
    {
        return static::shouldRegisterNavigation();
    }

    public static function form(Schema $schema): Schema
    {
        return LaborEntryForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return LaborEntriesTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListLaborEntries::route('/'),
            'create' => CreateLaborEntry::route('/create'),
            'edit' => EditLaborEntry::route('/{record}/edit'),
        ];
    }
}