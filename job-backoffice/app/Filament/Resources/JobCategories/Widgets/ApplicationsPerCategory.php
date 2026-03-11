<?php

namespace App\Filament\Resources\JobCategories\Widgets;

use App\Models\JobCategory;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class ApplicationsPerCategory extends ChartWidget
{
  protected ?string $heading = 'Application Volume Per Category';
  protected ?string $maxHeight = '400px';

  protected function getData(): array
  {
    // Get application count per category
    $categories = JobCategory::where('status', 'active')
      ->select('category_id', 'name')
      ->withCount([
        'jobVacancies as application_count' => function ($query) {
          $query->join('applications', 'job_vacancies.job_id', '=', 'applications.job_id')
            ->select(DB::raw('COUNT(applications.application_id)'));
        },
      ])
      ->orderByDesc('application_count')
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
          'label' => 'Application Count',
          'data' => $categories->pluck('application_count'),
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