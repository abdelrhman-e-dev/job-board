<?php

namespace App\Filament\Resources\JobCategories\Widgets;

use App\Models\JobCategory;
use App\Models\JobApplication;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\DB;

class CategoryStats extends BaseWidget
{
    protected function getStats(): array
    {
        $totalCategories = JobCategory::count();
        $activeCategories = JobCategory::where('status', 'active')->count();
        $totalPostings = JobCategory::withCount('jobVacancies')
            ->get()
            ->sum('job_vacancies_count');

        $totalApplications = DB::table('applications')
            ->join('job_vacancies', 'applications.job_id', '=', 'job_vacancies.job_id')
            ->join('job_categories', 'job_vacancies.category_id', '=', 'job_categories.category_id')
            ->count();

        $avgApplicationsPerPosting = $totalPostings > 0 
            ? round($totalApplications / $totalPostings, 2) 
            : 0;

        return [
            Stat::make('Total Categories', number_format($totalCategories))
                ->color('info')
                ->icon('heroicon-o-list-bullet')
                ->description('All job categories'),

            Stat::make('Active Categories', number_format($activeCategories))
                ->color('success')
                ->icon('heroicon-o-check-circle')
                ->description($totalCategories > 0 ? round(($activeCategories / $totalCategories) * 100) . '% active' : '0% active'),

            Stat::make('Total Postings', number_format($totalPostings))
                ->color('warning')
                ->icon('heroicon-o-document-text')
                ->description('Job vacancies across all categories'),

            Stat::make('Total Applications', number_format($totalApplications))
                ->color('primary')
                ->icon('heroicon-o-document-check')
                ->description($avgApplicationsPerPosting . ' avg per posting'),
        ];
    }
}