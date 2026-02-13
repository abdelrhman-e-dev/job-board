<?php

namespace App\Filament\Resources\Permissions\Tables;

use App\Models\Permission;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class PermissionsTable
{
  public static function configure(Table $table): Table
  {
    return $table

      ->columns([
        TextColumn::make('permission_name')
          ->label(__('Permission Name'))
          ->searchable()
          ->sortable()
          ->copyable()
          ->weight('bold'),
        TextColumn::make('visibility')
          ->badge()
          ->color(fn(string $state): string => match ($state) {
            'system_only' => 'success',
            'company_available' => 'info',
            default => 'gray',
          })
          ->sortable(),
        TextColumn::make('group')
          ->badge()
          ->color('gray')
          ->searchable()
          ->sortable(),
        TextColumn::make('description')
          ->searchable()
          ->limit(50)
          ->wrap(),
        TextColumn::make('created_at')
          ->dateTime()
          ->sortable()
          ->toggleable(isToggledHiddenByDefault: true),
        TextColumn::make('updated_at')
          ->dateTime()
          ->sortable()
          ->toggleable(isToggledHiddenByDefault: true),
        TextColumn::make('deleted_at')
          ->dateTime()
          ->sortable()
          ->toggleable(isToggledHiddenByDefault: true),
      ])
      ->filters([

        // filter based on group value

        SelectFilter::make('group')
          ->label(__('Group'))
          ->options(fn() => Permission::query()->distinct()->pluck('group', 'group')->toArray()),



      ])
      ->recordActions([
        EditAction::make(),
      ])
      ->toolbarActions([
        BulkActionGroup::make([
          DeleteBulkAction::make(),
          ForceDeleteBulkAction::make(),
          RestoreBulkAction::make(),
        ]),
      ]);
  }
}
