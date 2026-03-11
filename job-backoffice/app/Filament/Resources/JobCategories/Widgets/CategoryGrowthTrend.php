<?php

namespace App\Filament\Resources\JobCategories\Widgets;

use App\Models\JobCategory;
use Filament\Widgets\ChartWidget;

class CategoryGrowthTrend extends ChartWidget
{
    protected  ?string $heading = 'Category Growth Trend (Last 6 Months)';
      protected ?string $maxHeight = '400px';

    protected function getData(): array
    {
        // Get top 5 categories
        $topCategories = JobCategory::where('status', 'active')
            ->withCount('jobVacancies')
            ->orderByDesc('job_vacancies_count')
            ->limit(5)
            ->pluck('category_id');

        // Get monthly data for each category
        $monthLabels = [];
        $datasets = [];
        $colors = ['#3b82f6', '#10b981', '#f59e0b', '#ef4444', '#a855f7'];

        foreach ($topCategories as $index => $categoryId) {
            $category = JobCategory::find($categoryId);
            $monthlyData = [];

            for ($i = 5; $i >= 0; $i--) {
                $month = now()->subMonths($i);
                $count = $category->jobVacancies()
                    ->whereMonth('created_at', $month->month)
                    ->whereYear('created_at', $month->year)
                    ->count();
                $monthlyData[] = $count;

                if ($i === 5) {
                    $monthLabels[] = $month->format('M Y');
                }
            }

            $datasets[] = [
                'label' => $category->name,
                'data' => $monthlyData,
                'borderColor' => $colors[$index],
                'backgroundColor' => str_replace(')', ', 0.1)', str_replace('rgb', 'rgba', $colors[$index])),
                'tension' => 0.4,
                'fill' => false,
                'pointRadius' => 4,
                'pointBackgroundColor' => $colors[$index],
            ];
        }

        return [
            'datasets' => $datasets,
            'labels' => $monthLabels,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}