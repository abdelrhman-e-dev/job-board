<?php

namespace App\Filament\Resources\JobVacancies\Widgets;

use App\Models\JobVacancy;
use Filament\Widgets\ChartWidget;

class JobLocationTypeChart extends ChartWidget
{
  protected ?string $heading = 'Jobs by Location Type';
  protected ?string $maxHeight = '400px';
  protected function getData(): array
  {
    $locations = JobVacancy::selectRaw('location, count(*) as count')
      ->whereNotNull('location')
      ->groupBy('location')
      ->get();

    $labels = [];
    $data = [];

    foreach ($locations as $loc) {
      $labels[] = JobVacancy::LOCATION_TYPE_OPTIONS[$loc->location] ?? ucfirst($loc->location);
      $data[] = $loc->count;
    }

    return [
      'datasets' => [
        [
          'label' => 'Vacancies',
          'data' => $data,
          'backgroundColor' => [
            '#2563eb',
            '#047857',
            '#b45309',
            '#b91c1c',
          ],
          'hoverBackgroundColor' => [
            '#1e3a8a',
            '#064e3b',
            '#78350f',
            '#7f1d1d',
          ],
        ],
      ],
      'labels' => $labels,
    ];
  }

  protected function getType(): string
  {
    return 'doughnut';
  }
}
