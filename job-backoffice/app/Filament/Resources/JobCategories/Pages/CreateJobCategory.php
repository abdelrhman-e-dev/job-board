<?php

namespace App\Filament\Resources\JobCategories\Pages;

use App\Filament\Resources\JobCategories\JobCategoryResource;
use Filament\Resources\Pages\CreateRecord;

class CreateJobCategory extends CreateRecord
{
    protected static string $resource = JobCategoryResource::class;
}
