<?php

namespace App\Filament\Resources\CrewTimesheets\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CrewTimesheetsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('project.code')->label('Job'),
                TextColumn::make('user.name')->label('Crew'),
                TextColumn::make('work_date')->date(),
                TextColumn::make('hours'),
                TextColumn::make('status')->badge(),
                TextColumn::make('source'),
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