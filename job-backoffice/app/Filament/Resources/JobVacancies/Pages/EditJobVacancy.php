<?php

namespace App\Filament\Resources\JobVacancies\Pages;

use App\Filament\Resources\JobVacancies\JobVacancyResource;
use App\Models\Company;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditJobVacancy extends EditRecord
{
  protected static string $resource = JobVacancyResource::class;

  protected function getHeaderActions(): array
  {
    return [
      DeleteAction::make()
        ->requiresConfirmation()
        ->modalHeading('Delete Job Vacancy')
        ->modalDescription('This action will move the job vacancy to the trash and it will be deleted after 30 days.')
        ->modalSubmitActionLabel('Yes, delete it')
        ->before(function ($record) {
          $record->update([
            'status' => 'trashed',
          ]);
        }),
      ForceDeleteAction::make(),
      RestoreAction::make()
        ->requiresConfirmation()
        ->modalHeading('Restore Job Vacancy')
        ->modalDescription('This action will restore the job vacancy from the trash to draft.')
        ->modalSubmitActionLabel('Yes, restore it')
        ->after(function ($record) {
          $record->update([
            'status' => 'draft',
          ]);
        }),
    ];
  }
  protected function getRedirectUrl(): string
  {
    return static::getResource()::getUrl('index');
  }
  protected function beforeSave(): void
  {
    // check job post limit of the company before create/update the record
    $company = Company::find($this->data['company_id']);

    if ($company->job_posting_limit <= $company->jobs()->count()) {
      Notification::make()
        ->title('Job post limit reached')
        ->body("{$company->name} Company has reached the job post limit {$company->job_posting_limit}")
        ->danger()
        ->send();
      $this->halt();

    }
  }
}
