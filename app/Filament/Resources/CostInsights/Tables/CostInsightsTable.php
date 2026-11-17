<?php

namespace App\Filament\Resources\CostInsights\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CostInsightsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('project.code')->label('Job'),
                TextColumn::make('severity')->badge(),
                TextColumn::make('title')->searchable(),
                TextColumn::make('estimated_impact')->money('usd'),
                TextColumn::make('confidence')->suffix('%'),
                TextColumn::make('status')->badge(),
            ])
            ->filters([])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}