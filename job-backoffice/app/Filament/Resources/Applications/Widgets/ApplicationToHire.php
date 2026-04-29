<?php

namespace App\Filament\Resources\Applications\Widgets;

use App\Models\Application;
use Filament\Widgets\ChartWidget;

class ApplicationToHire extends ChartWidget
{
  protected ?string $heading = 'Application To Hire';
  protected bool $isCollapsible = true;

  protected function getData(): array
  {
    // hired applications
    $hired_applications = Application::where('status', 'hired')->count();
    $total_applications = Application::count();
    $not_hired_applications = $total_applications - $hired_applications;
    return [
      'datasets' => [
        [
          'label' => 'Application To Hire',
          'data' => [$hired_applications, $not_hired_applications],
          'backgroundColor' => [
            '#22c55e',
            '#f59e0b',
          ],
        ],
      ],
      'labels' => ['Hired Applications (' . $hired_applications . ')', 'Not Hired Applications (' . $not_hired_applications . ')'],
    ];
  }

  protected function getType(): string
  {
    return 'doughnut';
  }
}
