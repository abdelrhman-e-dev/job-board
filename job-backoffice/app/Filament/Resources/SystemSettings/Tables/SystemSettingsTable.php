<?php

namespace App\Filament\Resources\SystemSettings\Tables;

use App\Models\SystemSetting;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Cache\RateLimiting\Limit;

class SystemSettingsTable
{
  public static function configure(Table $table): Table
  {
    return $table
      ->columns([
        TextColumn::make('key')
          ->label('Setting Key')
          ->searchable()
          ->copyable()
          ->copyMessage('Key Copied!')
          ->weight('bold')
          ->searchable(),
        TextColumn::make('type')
          ->sortable()
          ->badge(),
        BadgeColumn::make('group')
          ->colors([
            'primary' => 'general',
            'success' => 'email',
            'warning' => 'payment',
            'danger' => 'security',
            'info' => 'features',
          ])
          ->sortable()
          ->label('Group'),
        TextColumn::make('value')
          ->limit(50)
          ->tooltip(fn(SystemSetting $record): string => $record->value ?? '')
          ->formatStateUsing(function ($state, SystemSetting $record) {
            if ($record->type === 'boolean') {
              return $state === '1' ? '✓ Yes' : '✗ No';
            }
            if ($record->type === 'image' || $record->type === 'file') {
              return $state ? '📎 File attached' : 'No file';
            }
            if ($record->type === 'json') {
              return 'JSON Data';
            }
            return $state;
          })
          ->label('Value'),
        IconColumn::make('is_public')
          ->boolean(),
        TextColumn::make('updated_at')
          ->label('Last Updated')
          ->dateTime()
          ->sortable()
          ->since(),
      ])
      ->filters([
        //
      ])
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
