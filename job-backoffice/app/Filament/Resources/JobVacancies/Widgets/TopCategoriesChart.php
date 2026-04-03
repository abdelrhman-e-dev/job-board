<?php

namespace App\Filament\Resources\JobVacancies\Widgets;

use App\Models\JobVacancy;
use Filament\Widgets\ChartWidget;

class TopCategoriesChart extends ChartWidget
{
  protected ?string $heading = 'Top Categories';

  protected ?string $maxHeight = '600px';
  protected function getData(): array
  {
    $categories = JobVacancy::selectRaw('job_categories.name as category_name, count(job_vacancies.category_id) as count')
      ->join('job_categories', 'job_categories.category_id', '=', 'job_vacancies.category_id')
      ->groupBy('job_categories.name')
      ->orderByDesc('count')
      ->limit(10)
      ->get();

    $labels = [];
    $data = [];

    foreach ($categories as $cat) {
      $labels[] = $cat->category_name;
      $data[] = $cat->count;
    }

    return [
      'datasets' => [
        [
          'label' => 'Vacancies',
          'data' => $data,
          'backgroundColor' => [
            '#2563eb',
            '#10b981',
            '#f59e0b',
            '#ef4444',
            '#8b5cf6',
            '#ec4899',
            '#06b6d4',
            '#3b82f6',
            '#14b8a6',
            '#f97316',
          ],
        ],
      ],
      'labels' => $labels,
    ];
  }

  protected function getType(): string
  {
    return 'bar';
  }
}
