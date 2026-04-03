<?php

namespace App\Filament\Resources\JobVacancies\Pages;

use App\Filament\Resources\JobVacancies\JobVacancyResource;
use App\Filament\Resources\JobVacancies\Widgets\ExpiringJobsTable;
use App\Filament\Resources\JobVacancies\Widgets\JobLevelChart;
use App\Filament\Resources\JobVacancies\Widgets\JobLocationTypeChart;
use App\Filament\Resources\JobVacancies\Widgets\JobSalaryInsights;
use App\Filament\Resources\JobVacancies\Widgets\JobStatsOverview;
use App\Filament\Resources\JobVacancies\Widgets\JobTypeChart;
use App\Filament\Resources\JobVacancies\Widgets\TopCategoriesChart;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Contracts\Support\Htmlable;

class ListJobVacancies extends ListRecords
{
    protected static string $resource = JobVacancyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
            ->label('Create Job'),
        ];
    }
    public function getTitle(): string | Htmlable
    {
        return 'Jobs';
    }

    protected function getHeaderWidgets(): array
    {
        return [
            JobStatsOverview::class,
            JobSalaryInsights::class,
            TopCategoriesChart::class,
            JobTypeChart::class,
            JobLevelChart::class,
            JobLocationTypeChart::class,
            ExpiringJobsTable::class,
        ];
    }
}
