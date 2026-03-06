<?php

namespace App\Filament\Actions;

use App\Models\Company;
use App\Services\Contracts\EmailServiceInterface;
use Filament\Actions\Action;
use Filament\Notifications\Notification;

class SendWelcomeEmailAction
{
    public static function make(EmailServiceInterface $emailService): Action
    {
        return Action::make('sendWelcomeEmail')
            ->label('Send Welcome Email')
            ->icon('heroicon-o-envelope')
            ->action(function (Company $record) use ($emailService) {
                $sent = $emailService->sendWelcomeEmail($record);

                if ($sent) {
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
            ->requiresConfirmation()
            ->modalHeading('Send Welcome Email')
            ->modalDescription('Send the welcome email to this company?')
            ->modalSubmitActionLabel('Send');
    }
}