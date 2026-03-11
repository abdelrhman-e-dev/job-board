<?php
namespace App\Filament\Actions\CompanyActions;

use App\Services\EmailService;
use Filament\Actions\Action;
use Filament\Notifications\Notification;

class UnsuspendCompanyAction
{
  public static function make(EmailService $emailService): Action
  {
    return Action::make('unsuspend')
      ->label('Unsuspend')
      ->icon('heroicon-o-no-symbol')
      ->color('danger')
      ->requiresConfirmation()
      ->modalHeading('Unsuspend Company')
      ->modalDescription('Are you sure you want to unsuspend this company?')
      ->modalSubmitActionLabel('Unsuspend')
      ->modalCancelActionLabel('Cancel')
      ->visible(fn($record) => $record->status === 'suspended')
      ->action(function ($record) use ($emailService) {
        $sent = $emailService->sendCompanyUnsuspensionEmail($record);
        if ($sent) {
          $record->unsuspend();
          Notification::make()
            ->success()
            ->title('Email Queued')
            ->body('Unsuspend email has been queued for sending.')
            ->send();
        } else {
          Notification::make()
            ->danger()
            ->title('Error')
            ->body('Failed to queue Unsuspend email.')
            ->send();
        }
      });
  }
}