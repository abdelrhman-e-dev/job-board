<?php

namespace App\Filament\Resources\JobVacancies\Widgets;

use App\Models\JobVacancy;
use Filament\Widgets\ChartWidget;

class JobTypeChart extends ChartWidget
{
  protected ?string $heading = 'Vacancies by Type';
  protected ?string $maxHeight = '600px';
  protected function getData(): array
  {
    $types = JobVacancy::selectRaw('type, count(*) as count')
      ->whereNotNull('type')
      ->groupBy('type')
      ->get();

    $labels = [];
    $data = [];

    foreach ($types as $type) {
      $labels[] = JobVacancy::TYPE_OPTIONS[$type->type] ?? ucfirst($type->type);
      $data[] = $type->count;
    }

    return [
      'datasets' => [
        [
          'label' => 'Vacancies',
          'data' => $data,
          'backgroundColor' => [
            '#3b82f6',
            '#10b981',
            '#f59e0b',
            '#ef4444',
          ],
          'hoverBackgroundColor' =>
            [
              '#1d4ed8',
              '#047857',
              '#b45309',
              '#b91c1c',
            ],
          'borderRadius' => 4,
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
