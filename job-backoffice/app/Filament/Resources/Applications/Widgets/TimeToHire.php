<?php

namespace App\Filament\Resources\Applications\Widgets;

use App\Models\Application;
use Filament\Widgets\ChartWidget;

class TimeToHire extends ChartWidget
{
  protected ?string $heading = 'Time To Hire';

  public ?string $filter = "6month";
  protected bool $isCollapsible = true;
  protected function getFilters(): array|null
  {
    return [
      '3months' => 'Last 3 Months',
      '6months' => 'Last 6 Months',
      '12months' => 'Last 12 Months',
    ];
  }
  protected function getData(): array
  {
    // determine range based on filter 
    $months = match ($this->filter) {
      '3months' => 3,
      '12months' => 12,
      default => 6,
    };

    // build month array as lables
    $data = [];
    $labels = [];
    for ($i = $months; $i >= 0; $i--) {
      $month = now()->subMonths($i);
      $labels[] = $month->format('M Y');
      $avgDays = Application::where('status', 'hired')
        ->whereNotNull('hired_at')
        ->whereMonth('created_at', $month->month)
        ->whereYear('created_at', $month->year)
        ->selectRaw('avg(DATEDIFF(hired_at, created_at)) as avg_days')
        ->value('avg_days');

      $data[] = round($avgDays ?? 0, 1);
    }
    return [
      'datasets' => [
        [
          'label' => 'Avg Days to Hire',
          'data' => $data,
          'backgroundColor' => '#22c55e',
          'borderColor' => '#16a34a',
          'borderWidth' => 2,
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
  protected function getOptions(): array
  {
    return [
      'plugins' => [
        'legend' => [
          'display' => false,
        ],
        'tooltip' => [
          'callbacks' => [
          ],
        ],
      ],
      'scales' => [
        'y' => [
          'beginAtZero' => true,
          'title' => [
            'display' => true,
            'text' => 'Days',
          ],
          'ticks' => [
            'stepSize' => 5,
          ],
        ],
        'x' => [
          'title' => [
            'display' => true,
            'text' => 'Month',
          ],
        ],
      ],
    ];
  }
}
