<?php

namespace App\Filament\Resources\JobVacancies\Widgets;

use App\Models\JobVacancy;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class JobStatsOverview extends BaseWidget
{
  protected function getStats(): array
  {
    return [
      Section::make('Job Vacancies Overview')
        ->schema([
          Grid::make(5)
            ->schema([
              Stat::make('Total Vacancies', JobVacancy::count())
                ->color('info')
                ->description('All registered jobs')
                ->icon('heroicon-o-briefcase'),
              Stat::make('Active / Published', JobVacancy::where('status', 'active')->count())
                ->color('success')
                ->description('Active jobs')
                ->icon('heroicon-o-check-circle'),
              Stat::make('Featured Listings', JobVacancy::where('is_featured', true)->count())
                ->color('warning')
                ->description('Featured jobs')
                ->icon('heroicon-o-star'),
              Stat::make('Expiring Soon', JobVacancy::where('deadline', '>=', now())
                ->where('deadline', '<=', now()->addDays(7))->count())
                ->color('warning')
                ->description('Expiring jobs')
                ->icon('heroicon-o-clock'),
              Stat::make('Expired', JobVacancy::where('deadline', '<', now())->count())
                ->color('danger')
                ->description('Expired jobs')
                ->icon('heroicon-o-x-circle'),
            ])
        ])->columnSpanFull()
    ];
  }
}
