<?php

namespace App\Filament\Widgets;

use App\Models\Project;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;

class RecentProjectsWidget extends TableWidget
{
    protected static ?string $heading = 'Recent Jobs';

    protected int|string|array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(Project::query()->latest()->limit(8))
            ->columns([
                TextColumn::make('code'),
                TextColumn::make('name'),
                TextColumn::make('status')->badge(),
                TextColumn::make('projected_margin_pct')->label('Margin %')->suffix('%'),
                TextColumn::make('projected_profit')->money('usd'),
            ])
            ->paginated(false);
    }
}