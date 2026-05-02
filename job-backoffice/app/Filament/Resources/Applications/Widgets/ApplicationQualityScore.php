<?php

namespace App\Filament\Resources\Applications\Widgets;

use App\Models\Application;
use Filament\Widgets\ChartWidget;

class ApplicationQualityScore extends ChartWidget
{
  protected ?string $heading = 'Application Quality Score';
  protected bool $isCollapsible = true;
  protected function getData(): array
  {

    $data = Application::groupBy('company_id')
      ->selectRaw('company_id, avg(aiGeneratedScore) as avg_quality')
      ->with('company:company_id,name')
      ->whereNotNull('aiGeneratedScore')
      ->orderByRaw('avg_quality DESC')
      ->limit(10)
      ->get();
    $companies = $data->pluck('company.name')->toArray();
    $qualities = $data->pluck('avg_quality')->map(fn($val) => round($val, 1))
      ->toArray();
    return [
      'datasets' => [
        [
          'label' => 'Average Application Quality Score',
          'data' => $qualities,
          'backgroundColor' => '#22c55e',
          'borderColor' => '#16a34a',
          'borderWidth' => 2,
          'borderRadius' => 4,
        ],
      ],
      'labels' => $companies,
    ];
  }

  protected function getType(): string
  {
    return 'bar';
  }
}
