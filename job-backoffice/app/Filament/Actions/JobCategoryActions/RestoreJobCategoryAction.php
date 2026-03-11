<?php
namespace App\Filament\Actions\JobCategoryActions;

use Filament\Actions\Action;
use Filament\Notifications\Notification;

class RestoreJobCategoryAction
{
  public static function make(): Action
  {
    return Action::make('RestoreCategory')
      ->label('Restore')
      ->icon('heroicon-o-arrow-uturn-left')
      ->action(
        function ($record) {
          // update the selected categroy
          $record->update([
            $record->status = 'active',
            $record->deleted_at = null
          ]);
          // update children
          if ($record->children()->count() > 0) {
            $record->children()->update([
              $record->status = 'active',
              $record->deleted_at = null
            ]);
          }
          Notification::make()
            ->success()
            ->title('Job category restored successfully')
            ->send();
        }
      )
      ->visible(fn($record) => $record->status == 'inactive')
      ->requiresConfirmation()
      ->modalHeading('Restore Job Category')
      ->modalDescription('Are you sure you want to restore this job category?')
      ->modalSubmitActionLabel('Yes, Restore')
      ->modalCancelActionLabel('Cancel')
      ->color('success');
  }
}