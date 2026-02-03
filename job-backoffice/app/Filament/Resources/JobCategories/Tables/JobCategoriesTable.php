<?php

namespace App\Filament\Resources\JobCategories\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class JobCategoriesTable
{
  public static function configure(Table $table): Table
  {
    return $table
      ->columns([
        TextColumn::make('name')
          ->searchable(),
        TextColumn::make('slug')
          ->searchable(),
        TextColumn::make('deleted_at')
          ->dateTime()
          ->sortable()
          ->toggleable(isToggledHiddenByDefault: true),
        TextColumn::make('job_vacancies_count')
          ->label('Job Count')
          ->counts('jobVacancies')
          ->sortable(),
        TextColumn::make('created_at')
          ->dateTime()
          ->sortable()
          ->toggleable(isToggledHiddenByDefault: true),
        TextColumn::make('updated_at')
          ->dateTime()
          ->sortable()
          ->toggleable(isToggledHiddenByDefault: true),
      ])
      ->filters([
        TrashedFilter::make(),
      ])
      ->recordActions([
        EditAction::make(),
        DeleteAction::make()
          ->before(function (DeleteAction $action, $record) {
            if ($record->jobVacancies()->count() > 0) {
              Notification::make()
                ->warning()
                ->title('Cannot delete job category')
                ->body('Job category has job vacancies')
                ->send();
              $action->halt();
            }
          })
          ->requiresConfirmation()
          ->modalHeading('Delete Job Category')
          ->modalDescription('Are you sure you want to delete this job category? This action cannot be undone.')
          ->modalSubmitActionLabel('Yes, delete it')
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
