<?php

namespace App\Filament\Resources\JobCategories\Widgets;

use App\Models\JobCategory;
use Filament\Widgets\ChartWidget;

class TrendingCategories extends ChartWidget
{
  protected ?string $heading = 'Trending Categories (This Month)';
    protected ?string $maxHeight = '400px';
    protected function getData(): array
    {
        $startOfMonth = now()->startOfMonth();
        $endOfMonth = now()->endOfMonth();

        // Get new postings this month per category
        $categories = JobCategory::where('status', 'active')
            ->withCount([
                'jobVacancies as monthly_postings' => function ($query) use ($startOfMonth, $endOfMonth) {
                    $query->whereBetween('created_at', [$startOfMonth, $endOfMonth]);
                },
            ])
            ->having('monthly_postings', '>', 0)
            ->orderByDesc('monthly_postings')
            ->limit(10)
            ->get();

        return [
            'datasets' => [
                [
                    'label' => 'New Postings This Month',
                    'data' => $categories->pluck('monthly_postings'),
                    'backgroundColor' => '#10b981',
                    'borderColor' => '#059669',
                    'borderWidth' => 1,
                ],
            ],
            'labels' => $categories->pluck('name'),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}