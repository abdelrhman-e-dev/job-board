<?php

namespace App\Filament\Resources\JobCategories\Pages;

use App\Filament\Resources\JobCategories\JobCategoryResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EditJobCategory extends EditRecord
{
  protected static string $resource = JobCategoryResource::class;

  protected function getHeaderActions(): array
  {
    return [
      DeleteAction::make()
        ->color('warning')
        ->label('Archive')
        ->icon('heroicon-o-archive-box-arrow-down')
        ->before(
          function (DeleteAction $action, $record) {
            if ($record->jobVacancies()->count() > 0) {
              Notification::make()
                ->title('Cannot archive job category')
                ->body('Job category has job vacancies')
                ->warning()
                ->send();
              $action->halt();
            }
          }
        )
        ->requiresConfirmation()
        ->modalHeading('Archive Job Category')
        ->modalDescription('Are you sure you want to archive this job category? This action cannot be undone.')
        ->modalSubmitActionLabel('Yes, Archive'),
      ForceDeleteAction::make()
        ->label('Delete')
        ->icon('heroicon-o-trash')
        ->requiresConfirmation()
        ->modalHeading('Delete Job Category')
        ->modalDescription('Are you sure you want to delete this job category? This action cannot be undone.')
        ->modalSubmitActionLabel('Yes, Delete'),
      RestoreAction::make()
        ->label('Restore')
        ->icon('heroicon-o-arrow-path')
        ->requiresConfirmation()
        ->modalHeading('Restore Job Category')
        ->modalDescription('Are you sure you want to restore this job category? This action cannot be undone.')
        ->modalSubmitActionLabel('Yes, Restore'),
    ];
  }
  public static function getRecordRouteBindingEloquentQuery(): Builder
  {
    return parent::getRecordRouteBindingEloquentQuery()
      ->withoutGlobalScopes([
        SoftDeletingScope::class,
      ]);
  }
}
