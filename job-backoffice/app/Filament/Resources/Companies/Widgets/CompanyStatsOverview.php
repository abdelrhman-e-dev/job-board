<?php

namespace App\Filament\Resources\Companies\Widgets;

use App\Models\Company;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class CompanyStatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $totalCompanies = Company::count();
        $activeCompanies = Company::where('verified', true)->count();
        $totalEmployees = User::all()->where('company_id', '!=', null)->count();
        $avgEmployees = $totalCompanies > 0 ? $totalEmployees / $totalCompanies : 0;

        return [
            Stat::make('Total Companies', number_format($totalCompanies))
                ->color('info')
                ->description('All registered companies')
                ->icon('heroicon-o-building-office'),
            
            Stat::make('Active Companies', number_format($activeCompanies))
                ->color('success')
                ->description($totalCompanies > 0 ? round(($activeCompanies / $totalCompanies) * 100) . '% active' : '0% active')
                ->icon('heroicon-o-check-circle'),
            
            Stat::make('Total Employees', number_format($totalEmployees))
                ->color('warning')
                ->description('Across all companies')
                ->icon('heroicon-o-users'),
            
            Stat::make('Avg Employees', number_format($avgEmployees, 0))
                ->color('primary')
                ->description('Per company')
                ->icon('heroicon-o-chart-bar'),
        ];
    }
}