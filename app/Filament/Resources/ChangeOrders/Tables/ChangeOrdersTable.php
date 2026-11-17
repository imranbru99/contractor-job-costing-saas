<?php

namespace App\Filament\Resources\ChangeOrders\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ChangeOrdersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('project.code')->label('Job'),
                TextColumn::make('number')->searchable(),
                TextColumn::make('title')->searchable(),
                TextColumn::make('status')->badge(),
                TextColumn::make('amount')->money('usd'),
                TextColumn::make('margin_impact')->money('usd'),
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