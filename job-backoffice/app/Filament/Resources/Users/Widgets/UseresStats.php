<?php

namespace App\Filament\Resources\Users\Widgets;

use App\Models\User;
use Filament\Schemas\Components\Grid;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class UseresStats extends StatsOverviewWidget
{
  protected function getStats(): array
  {
    return [
      Grid::make()
        ->columnSpanFull()
        ->columns(4)
        ->schema([
          // Row 1
          Stat::make('Total Users', User::with('role')->whereHas('role', function ($query) {
            $query->where('role_name', '!=', 'system-admin');
          })->count())
            ->description('All registered users except admins')
            ->descriptionIcon('heroicon-m-users')
            ->color('primary')
            ->icon('heroicon-o-user-group')
            ->columnSpan(2),

          Stat::make(
            'Active Accounts',
            User::whereNotNull('email_verified_at')
              ->with('role')->whereHas('role', function ($query) {
                $query->where('role_name', '==', 'company-owner');
              })->count()
          )
            ->description('Verified & active users')
            ->descriptionIcon('heroicon-m-check-circle')
            ->color('success')
            ->icon('heroicon-o-check-badge'),

          Stat::make(
            'Inactive Accounts',
            User::whereNull('email_verified_at')
              ->with('role')->whereHas('role', function ($query) {
                $query->where('role_name', '!=', 'system-admin');
              })->count()
          )
            ->description('Unverified accounts')
            ->descriptionIcon('heroicon-m-x-circle')
            ->color('danger')
            ->icon('heroicon-o-x-circle'),
          // Row 2
          Stat::make('Job Seekers', User::with('role')->whereHas('role', function ($query) {
            $query->where('role_name', '=', 'job-seeker');
          })->count())
            ->description('Users looking for jobs')
            ->descriptionIcon('heroicon-m-briefcase')
            ->color('info')
            ->icon('heroicon-o-user'),

          Stat::make('Company Owners', User::with('role')->whereHas('role', function ($query) {
            $query->where('role_name', '=', 'company-owner');
          })->count())
            ->description('Registered companies owners')
            ->descriptionIcon('heroicon-o-identification')
            ->color('info')
            ->icon('heroicon-o-building-office'),

          Stat::make('Hiring Mangers', User::with('role')->whereHas('role', function ($query) {
            $query->where('role_name', '=', 'hiring-manager');
          })->count())
            ->description('Registered hiring managers')
            ->descriptionIcon('heroicon-o-identification')
            ->color('info')
            ->icon('heroicon-o-user'),

          Stat::make('Recruiters', User::with('role')->whereHas('role', function ($query) {
            $query->where('role_name', '=', 'recruiter');
          })->count())
            ->description('Registered recruiters')
            ->descriptionIcon('heroicon-o-identification')
            ->color('info')
            ->icon('heroicon-o-user'),
        ])
    ];
  }
}
