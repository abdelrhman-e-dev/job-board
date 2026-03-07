<?php

namespace App\Filament\Resources\Companies\Widgets;

use App\Models\Company;
use App\Models\User;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
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

      Section::make('Company Stats')
        ->schema([
          Grid::make(4)
            ->schema([
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
            ]),
        ])->columnSpanFull(),
      Section::make('Company Status Stats')
        ->schema([
          Grid::make(4)
            ->schema([
              Stat::make('Pending Companies', number_format(Company::where('status', 'pending')->count()))
                ->color('warning')
                ->description('Pending companies')
                ->icon('heroicon-o-clock'),
              Stat::make('Approved Companies', number_format(Company::where('status', 'approved')->count()))
                ->color('success')
                ->description('Approved companies')
                ->icon('heroicon-o-check-circle'),
              Stat::make('Rejected Companies', number_format(Company::where('status', 'rejected')->count()))
                ->color('danger')
                ->description('Rejected companies')
                ->icon('heroicon-o-x-circle'),
              Stat::make('Suspended Companies', number_format(Company::where('status', 'suspended')->count()))
                ->color('danger')
                ->description('Suspended companies')
                ->icon('heroicon-o-no-symbol'),
            ])
        ])->columnSpanFull()
    ];
  }
}