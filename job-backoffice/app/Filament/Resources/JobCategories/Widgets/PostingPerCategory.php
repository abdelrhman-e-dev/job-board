<?php

namespace App\Filament\Resources\JobCategories\Widgets;

use App\Models\JobCategory;
use Filament\Widgets\ChartWidget;

class JobPostingsPerCategory extends ChartWidget
{
  protected ?string $heading = 'Job Postings Per Category';
    protected ?string $maxHeight = '400px';

  protected function getData(): array
  {
    $categories = JobCategory::where('status', 'active')
      ->withCount('jobVacancies')
      ->orderByDesc('job_vacancies_count')
      ->limit(12)
      ->get();

    $colors = [
      '#3b82f6',
      '#10b981',
      '#f59e0b',
      '#ef4444',
      '#a855f7',
      '#ec4899',
      '#6366f1',
      '#14b8a6',
      '#8b5cf6',
      '#06b6d4',
      '#f97316',
      '#84cc16',
    ];

    return [
      'datasets' => [
        [
          'label' => 'Number of Postings',
          'data' => $categories->pluck('job_vacancies_count'),
          'backgroundColor' => array_slice($colors, 0, $categories->count()),
          'borderColor' => '#1f2937',
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