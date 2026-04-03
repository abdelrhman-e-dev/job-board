<?php

namespace App\Filament\Resources\JobVacancies\Widgets;

use App\Models\JobVacancy;
use Filament\Widgets\ChartWidget;

class JobLevelChart extends ChartWidget
{
    protected   ?string $heading = 'Vacancies by Level';
  protected ?string $maxHeight = '400px';

    protected function getData(): array
    {
        $levels = JobVacancy::selectRaw('level, count(*) as count')
            ->whereNotNull('level')
            ->groupBy('level')
            ->get();

        $labels = [];
        $data = [];

        foreach ($levels as $level) {
            $labels[] = JobVacancy::LEVEL_OPTIONS[$level->level] ?? ucfirst($level->level);
            $data[] = $level->count;
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
                        '#1e3a8a',
                    ],
                    'hoverBackgroundColor' => [
                        '#1e3a8a',
                        '#064e3b',
                        '#78350f',
                        '#7f1d1d',  
                        '#172554',
                    ],
                    'borderRadius' => 4,
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
