<?php

namespace App\Filament\Resources\Users\Widgets;

use App\Models\User;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class UseresStats extends StatsOverviewWidget
{
    protected function getColumns(): int
    {
        return 3; // 3 cards per row
    }

    protected function getStats(): array
    {
        return [

            // Row 1
            Stat::make('Total Users', User::whereNot('role', 'system-admin')->count())
                ->description('All registered users except admins')
                ->descriptionIcon('heroicon-m-users')
                ->color('primary')
                ->icon('heroicon-o-user-group')
                ->columnSpan(1),

            Stat::make('Job Seekers', User::where('role', 'job-seeker')->count())
                ->description('Users looking for jobs')
                ->descriptionIcon('heroicon-m-briefcase')
                ->color('success')
                ->icon('heroicon-o-user')
                ->columnSpan(1),

            Stat::make('Company Owners', User::where('role', 'company-owner')->count())
                ->description('Registered companies owners')
                ->descriptionIcon('heroicon-o-identification')
                ->color('warning')
                ->icon('heroicon-o-building-office')
                ->columnSpan(1),

            // Row 2
            Stat::make('Active Accounts', 
                User::whereNotNull('email_verified_at')
                    ->whereNot('role', 'system-admin')
                    ->count()
            )
                ->description('Verified & active users')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success')
                ->icon('heroicon-o-check-badge')
                ->columnSpan(2),

            Stat::make('Inactive Accounts', 
                User::whereNull('email_verified_at')
                    ->whereNot('role', 'system-admin')
                    ->count()
            )
                ->description('Unverified accounts')
                ->descriptionIcon('heroicon-m-x-circle')
                ->color('danger')
                ->icon('heroicon-o-x-circle')
                ->columnSpan(1),
        ];
    }
}
