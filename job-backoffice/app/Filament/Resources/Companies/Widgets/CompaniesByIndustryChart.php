<?php

namespace App\Filament\Resources\Companies\Widgets;

use App\Models\Company;
use Filament\Widgets\ChartWidget;

class CompaniesByIndustryChart extends ChartWidget
{
    protected ?string $heading = 'Companies By Industry Chart';
  protected ?string $maxHeight = '400px';
    protected function getData(): array
    {
        $data = Company::select('industry', 'company_id')
            ->get()
            ->groupBy('industry')
            ->map(function ($group) {
                return $group->count();
            });

        return [
            'datasets' => [
                [
                    'label' => 'Companies',
                    'data' => $data->values(),
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
            'labels' => $data->keys(),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
