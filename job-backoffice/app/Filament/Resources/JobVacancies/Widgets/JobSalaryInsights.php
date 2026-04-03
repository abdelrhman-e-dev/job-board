<?php

namespace App\Filament\Resources\JobVacancies\Widgets;

use App\Models\JobVacancy;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\DB;

class JobSalaryInsights extends BaseWidget
{
    protected function getStats(): array
    {
        $currencyStats = JobVacancy::select(
                'salary_currency',
                DB::raw('count(*) as count'),
                DB::raw('avg(salary_min) as avg_min'),
                DB::raw('avg(salary_max) as avg_max')
            )
            ->whereNotNull('salary_currency')
            ->where('status', 'active')
            ->groupBy('salary_currency')
            ->get();

        $stats = [];

        // Section title stat (acts as a header/divider)
        $totalJobsWithCurrency = JobVacancy::whereNotNull('salary_currency')
            ->where('status', 'active')
            ->count();

        $stats[] = Stat::make('Salary Insights — Active Jobs', $totalJobsWithCurrency)
            ->description('Active jobs with salary data')
            ->descriptionIcon('heroicon-m-briefcase')
            ->color('primary');
        $currencyIcons = [
            'USD' => 'heroicon-m-currency-dollar',
            'EUR' => 'heroicon-m-currency-euro',
            'GBP' => 'heroicon-m-currency-pound',
            'EGP' => 'heroicon-m-banknotes',
            'SAR' => 'heroicon-m-banknotes',
            'AED' => 'heroicon-m-banknotes',
            'KWD' => 'heroicon-m-banknotes',
            'QAR' => 'heroicon-m-banknotes',
        ];

        $currencyColors = [
            'USD' => 'success',
            'EUR' => 'info',
            'GBP' => 'warning',
            'EGP' => 'danger',
            'SAR' => 'danger',
            'AED' => 'danger',
            'KWD' => 'danger',
            'QAR' => 'danger',
        ];

        foreach ($currencyStats as $stat) {
            $currencyLabel = JobVacancy::CURRENCY_OPTIONS[$stat->salary_currency] ?? $stat->salary_currency;
            $range = number_format($stat->avg_min, 0) . ' – ' . number_format($stat->avg_max, 0);

            $icon  = $currencyIcons[$stat->salary_currency]  ?? 'heroicon-m-banknotes';
            $color = $currencyColors[$stat->salary_currency] ?? 'gray';

            $stats[] = Stat::make("Salary Insights — Avg Range ({$currencyLabel})", $range)
                ->description("Based on {$stat->count} active {$currencyLabel} jobs")
                ->descriptionIcon($icon)
                ->color($color);
        }

        return $stats;
    }
}