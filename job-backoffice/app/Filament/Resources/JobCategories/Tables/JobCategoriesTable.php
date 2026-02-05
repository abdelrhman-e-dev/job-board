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
        TextColumn::make('job_vacancies_count')
          ->label('Job Count')
          ->counts('jobVacancies')
          ->sortable(),
        TextColumn::make('created_at')
          ->dateTime()
          ->sortable(),
        TextColumn::make('deleted_at')
          ->dateTime()
          ->sortable()
          ->placeholder('-'),
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
          ->label('Archive')
          ->icon('heroicon-o-archive-box-arrow-down')
          ->before(function (DeleteAction $action, $record) {
            if ($record->jobVacancies()->count() > 0 || $record->children()->count() > 0) {
              Notification::make()
                ->warning()
                ->title('Cannot archive job category')
                ->body('Job category has job vacancies or children')
                ->send();
              $action->halt();
            }
          })
          ->requiresConfirmation()
          ->modalHeading('Archive Job Category')
          ->modalDescription('Are you sure you want to archive this job category? This action cannot be undone.')
          ->modalSubmitActionLabel('Yes, Archive'),
        RestoreAction::make(),
      ])
      ->toolbarActions([
        BulkActionGroup::make([
          DeleteBulkAction::make()
            ->label('Archive Selected')
            ->icon('heroicon-o-archive-box-arrow-down')
            ->before(function (DeleteBulkAction $action, $record) {
              if ($record->jobVacancies()->count() > 0 || $record->children()->count() > 0) {
                Notification::make()
                  ->warning()
                  ->title('Cannot archive job category')
                  ->body('Job category has job vacancies or children')
                  ->send();
                $action->halt();
              }
            })
            ->requiresConfirmation()
            ->modalHeading('Archive Job Category')
            ->modalDescription('Are you sure you want to archive this job category? This action cannot be undone.')
            ->modalSubmitActionLabel('Yes, Archive'),
          ForceDeleteBulkAction::make(),
          RestoreBulkAction::make(),
        ]),
      ]);

  }
}
