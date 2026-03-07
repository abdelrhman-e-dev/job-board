<?php
namespace App\Filament\Actions;

use App\Services\Contracts\EmailServiceInterface;
use App\Services\EmailService;
use Filament\Actions\Action;
use Filament\Notifications\Notification;

class SuspendCompanyAction
{
  public static function make(EmailServiceInterface $emailService): Action
  {
    return Action::make('suspend')
      ->label('Suspend')
      ->icon('heroicon-o-no-symbol')
      ->color('danger')
      ->requiresConfirmation()
      ->modalHeading('Suspend Company')
      ->modalDescription('Are you sure you want to suspend this company?')
      ->modalSubmitActionLabel('Suspend')
      ->modalCancelActionLabel('Cancel')
      ->visible(fn($record) => $record->status !== 'aproved')
      ->action(function ($record) use ($emailService) {
        $record->update([
          'verified' => false,
          'verified_at' => null,
          'verification_expires_at' => null,
          'status' => 'suspended',
          'suspended_at' => now()
        ]);
        $sent = $emailService->sendCompanySuspensionEmail($record);
        if ($sent) {
          Notification::make()
            ->success()
            ->title('Email Queued')
            ->body('Suspend email has been queued for sending.')
            ->send();
        } else {
          Notification::make()
            ->danger()
            ->title('Error')
            ->body('Failed to queue Suspend email.')
            ->send();
        }
      });
  }
}