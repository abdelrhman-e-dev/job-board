<?php

namespace App\Filament\Actions\CompanyActions;

use App\Models\Company;
use App\Services\EmailService;
use Filament\Actions\Action;
use Filament\Notifications\Notification;

class SendWelcomeEmailAction
{
  public static function make(EmailService $emailService): Action
  {
    return Action::make('sendWelcomeEmail')
      ->label('Send Welcome Email')
      ->icon('heroicon-o-envelope')
      ->action(
        function ($record) use ($emailService)
        {
          $sent = $emailService->sendWelcomeEmail($record);
          if ($sent) {
            $record->update(['welcome_email_sent' => 1]);
            Notification::make()
              ->success()
              ->title('Email Queued')
              ->body('Welcome email has been queued for sending.')
              ->send();
          } else {
            Notification::make()
              ->danger()
              ->title('Error')
              ->body('Failed to queue welcome email.')
              ->send();
          }
        })
      ->visible(fn($record) => !$record->welcome_email_sent)
      ->requiresConfirmation()
      ->modalHeading('Send Welcome Email')
      ->modalDescription('Send the welcome email to this company?')
      ->modalSubmitActionLabel('Send');
  }
}