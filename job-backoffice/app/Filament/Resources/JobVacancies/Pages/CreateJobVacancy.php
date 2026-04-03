<?php

namespace App\Filament\Resources\JobVacancies\Pages;

use App\Filament\Resources\JobVacancies\JobVacancyResource;
use App\Models\Company;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;


class CreateJobVacancy extends CreateRecord
{
  protected static string $resource = JobVacancyResource::class;
  protected function getRedirectUrl(): string
  {
    return static::getResource()::getUrl('index');  
  }
  protected function beforeCreate(): array
  {
    // check job post limit of the company before create the record
    $company = Company::find($this->data['company_id']);
    if ($company['job_posting_limit'] <= $company->jobs()->count()) {
      Notification::make()
        ->title('Job post limit reached')
        ->body("{$company['name']} Company has reached the job post limit {$company['job_posting_limit']}")
        ->danger()
        ->send();
      return $this->halt();
    }
    return $this->data;
  }
}
