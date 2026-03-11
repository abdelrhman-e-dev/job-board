<?php
namespace App\Filament\Actions\JobCategoryActions;

use Filament\Actions\Action;
use Filament\Notifications\Notification;

class InactiveJobCategoryAction
{
  public static function make(): Action
  {
    return Action::make('InactiveCategory')
      ->label('Inactive')
      ->icon('heroicon-o-x-circle')
      ->action(
        function ($record) {
          // show warring if the  category has children or job vacancies
          if ($record->jobVacancies()->count() > 0) {
            Notification::make()
              ->warning()
              ->title('Job category has job vacancies')
              ->body('Job category has job vacancies')
              ->send();
            return;
          }
          // update the selected categroy
          $record->update([
            $record->status = 'inactive',
          ]);
          Notification::make()
            ->success()
            ->title('Job category inactivated successfully')
            ->send();
        }
      )
      ->visible(fn($record) => $record->status == 'active')
      ->requiresConfirmation()
      ->modalHeading('Inactive Job Category')
      ->modalDescription('Are you sure you want to inactive this job category?')
      ->modalSubmitActionLabel('Yes, Inactive')
      ->modalCancelActionLabel('Cancel')
      ->color('danger');
  }
}