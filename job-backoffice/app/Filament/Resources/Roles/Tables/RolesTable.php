<?php

namespace App\Filament\Resources\Roles\Tables;

use App\Models\Role;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\BadgeColumn;
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
        TextColumn::make('user_count')
          ->label('Roles Count')
          ->counts('user')
          ->sortable(),
        BadgeColumn::make('active')
          ->label('Active')
          ->badge()
          ->color(fn($state) => $state ? 'success' : 'danger')
          ->formatStateUsing(fn($state) => $state ? 'Active' : 'Inactive'),
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
          SelectFilter::make('active')
          ->options(
            [
              '1' => 'Active',
              '0' => 'Inactive',
            ]
          ),
      ])
      ->recordActions([
        EditAction::make(),
        Action::make('toggle_status')
          ->label(fn($record) => $record->active ? 'Deactivate' : 'Activate')
          ->icon(fn($record) => $record->active ? 'heroicon-m-x-circle' : 'heroicon-m-check-circle')
          ->color(fn($record) => $record->active ? 'danger' : 'success')
          ->action(function ($record) {
            $record->active = !$record->active;
            $record->save();
          }),
      ])
      ->toolbarActions([
        BulkActionGroup::make([

        ]),
      ]);
  }
}
