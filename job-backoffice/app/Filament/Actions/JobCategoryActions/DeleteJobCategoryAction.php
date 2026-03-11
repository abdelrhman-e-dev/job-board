<?php
namespace App\Filament\Actions\JobCategoryActions;

use Filament\Actions\Action;
use Filament\Notifications\Notification;

class DeleteJobCategoryAction
{
  public static function make(): Action
  {
    return Action::make('DeleteCategory')
      ->label('Delete')
      ->icon('heroicon-o-trash')
      ->action(
        function ($record) {
          // check if category or any children used in jobs 
          if ($record->jobVacancies()->count() > 0 || $record->children()->count() > 0) {
            Notification::make()
              ->warning()
              ->title('Cannot delete job category')
              ->body('Job category has job vacancies or children')
              ->send();
            return;
          }
          // update the selected categroy
          $record->update([
            $record->status = 'inactive',
            $record->deleted_at = now()
          ]);
          // update children
          if ($record->children()->count() > 0) {
            $record->children()->update([
              $record->status = 'inactive',
              $record->deleted_at = now()
            ]);
          }
          Notification::make()
            ->success()
            ->title('Job category deleted successfully')
            ->send();
        }
      )
      ->visible(fn($record) => $record->status == 'active')
      ->requiresConfirmation()
      ->modalHeading('Delete Job Category')
      ->modalDescription('Are you sure you want to delete this job category?')
      ->modalSubmitActionLabel('Yes, Delete')
      ->modalCancelActionLabel('Cancel')
      ->color('danger');
  }
}