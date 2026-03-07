<?php

namespace App\Filament\Resources\Companies\Widgets;
use App\Models\Company;
use Filament\Widgets\ChartWidget;

class CompanyGrowthChart extends ChartWidget
{
  protected ?string $heading = 'Company Registration Growth';

  protected function getData(): array
  {
    $registrations = Company::selectRaw('DATE(created_at) as date, COUNT(*) as count')
      ->where('created_at', '>=', now()->subMonths(12))
      ->groupBy('date')
      ->orderBy('date')
      ->get();

    // Calculate cumulative count
    $cumulativeData = [];
    $total = 0;

    foreach ($registrations as $registration) {
      $total += $registration->count;
      $cumulativeData[] = $total;
    }

    $dates = $registrations->pluck('date')->map(fn($date) => date('M d', strtotime($date)));

    return [
      'datasets' => [
        [
          'label' => 'Total Registrations',
          'data' => $cumulativeData,
          'borderColor' => '#3b82f6',
          'backgroundColor' => 'rgba(59, 130, 246, 0.1)',
          'tension' => 0.4,
          'fill' => true,
          'pointRadius' => 4,
          'pointBackgroundColor' => '#3b82f6',
        ],
      ],
      'labels' => $dates,
    ];
  }

  protected function getType(): string
  {
    return 'line';
  }
}
