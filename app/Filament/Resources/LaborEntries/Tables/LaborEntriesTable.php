<?php

namespace App\Filament\Resources\LaborEntries\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class LaborEntriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('project.code')->label('Job')->searchable(),
                TextColumn::make('user.name')->label('Worker'),
                TextColumn::make('work_date')->date(),
                TextColumn::make('crew_role'),
                TextColumn::make('hours'),
                TextColumn::make('total_cost')->money('usd'),
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