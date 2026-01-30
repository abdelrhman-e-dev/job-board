<?php

namespace App\Filament\Resources\JobVacancies\Pages;

use App\Filament\Resources\JobVacancies\JobVacancyResource;
use Filament\Resources\Pages\CreateRecord;

class CreateJobVacancy extends CreateRecord
{
    protected static string $resource = JobVacancyResource::class;
}
