<?php

namespace App\Filament\Resources\Roles\Tables;

use App\Models\Role;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class RolesTable
{
  public static function configure(Table $table): Table
  {
    return $table
      ->columns([
        TextColumn::make('role_name')
          ->label('Role Name')
          ->icon('heroicon-m-user-group')
          ->searchable()
          ->sortable(),
        TextColumn::make('created_at')
          ->label('Created At')
          ->dateTime('d, M Y')
          ->sortable()
      ])
      ->filters([
        SelectFilter::make('role_name')
          ->options(
            Role::getRoles()->pluck('role_name', 'role_name')->toArray()
          ),
      ])
      ->recordActions([
        EditAction::make(),
        DeleteAction::make(),
      ])
      ->toolbarActions([
        BulkActionGroup::make([
          DeleteBulkAction::make(),
        ]),
      ]);
  }
}
