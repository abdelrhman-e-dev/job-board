<?php

namespace App\Filament\Resources\Users\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class UsersTable
{
  public static function configure(Table $table): Table
  {
    return $table
      ->columns([
        ImageColumn::make('avatar')
          ->visibility('public')
          ->circular()
          ->defaultImageUrl('https://png.pngtree.com/png-vector/20220719/ourmid/pngtree-color-icon---businessman-icon-color-sign-vectorteamwork-account-admin-photo-image_37961448.jpg'),
        TextColumn::make('full_name')
          ->label('Full Name')
          ->searchable(query: function ($query, $search) {
            $query->where(function ($q) use ($search) {
              $q->where('first_name', 'like', "%{$search}%")
                ->orWhere('last_name', 'like', "%{$search}%");
            });
          })
          ->getStateUsing(fn($record) => $record->full_name),
        TextColumn::make('email')
          ->label('Email address')
          ->limit(10)
          ->searchable(),
        TextColumn::make('role')
          ->badge()
          ->color(
            fn(string $state): string => match ($state) {
              'system-admin' => 'danger',
              'company-owner' => 'warning',
              'hiring-manager' => 'info',
              'recruiter' => 'success',
              'job-seeker' => 'gray',
              default => 'gray',
            }
          ),
        TextColumn::make('company.name')
          ->label('Company')
          ->sortable()
          ->placeholder('—'),
        TextColumn::make('phone')
          ->searchable(),
        TextColumn::make('country')
          ->searchable(),
        TextColumn::make('deleted_at')
          ->dateTime()
          ->sortable()
          ->toggleable(isToggledHiddenByDefault: true),
        TextColumn::make('created_at')
          ->dateTime('M d')
          ->sortable(),
        TextColumn::make('created_at')
          ->dateTime('M d')
          ->sortable(),
      ])
      ->filters([
        TrashedFilter::make(),
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
