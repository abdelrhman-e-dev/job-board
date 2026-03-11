<?php
namespace App\Filament\Actions\JobCategoryActions;

use Filament\Actions\Action;
use Filament\Notifications\Notification;

class ActiveJobCategoryAction
{
  public static function make(): Action
  {
    return Action::make('ActiveCategory')
      ->label('Active')
      ->icon('heroicon-o-check-circle')
      ->action(
        function ($record) {
          // update the selected categroy
          $record->update([
            $record->status = 'active',
          ]);
          // update children
          if($record->children()->count() > 0){
            $record->children()->update([
              $record->status = 'active',
            ]);
          }
          Notification::make()
            ->success()
            ->title('Job category activated successfully')
            ->send();
        }
      )
      ->visible(fn($record) => $record->status == 'inactive')
      ->requiresConfirmation()
      ->modalHeading('Active Job Category')
      ->modalDescription('Are you sure you want to active this job category?')
      ->modalSubmitActionLabel('Yes, Active')
      ->modalCancelActionLabel('Cancel')
      ->color('success');
  }
}