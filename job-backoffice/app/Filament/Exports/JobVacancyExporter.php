<?php

namespace App\Filament\Exports;

use App\Models\JobVacancy;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;
use Illuminate\Support\Number;

class JobVacancyExporter extends Exporter
{
    protected static ?string $model = JobVacancy::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('job_id'),
            ExportColumn::make('company_id'),
            ExportColumn::make('category_id'),
            ExportColumn::make('posted_by'),
            ExportColumn::make('closed_by'),
            ExportColumn::make('title'),
            ExportColumn::make('slug'),
            ExportColumn::make('description'),
            ExportColumn::make('requirements'),
            ExportColumn::make('type'),
            ExportColumn::make('location'),
            ExportColumn::make('city'),
            ExportColumn::make('level'),
            ExportColumn::make('education'),
            ExportColumn::make('experience_years'),
            ExportColumn::make('is_featured'),
            ExportColumn::make('approved_by'),
            ExportColumn::make('approved_at'),
            ExportColumn::make('flags_count'),
            ExportColumn::make('visibility'),
            ExportColumn::make('boost_expires_at'),
            ExportColumn::make('source'),
            ExportColumn::make('external_url'),
            ExportColumn::make('salary_min'),
            ExportColumn::make('salary_max'),
            ExportColumn::make('salary_currency'),
            ExportColumn::make('screening_questions'),
            ExportColumn::make('status'),
            ExportColumn::make('views_count'),
            ExportColumn::make('applications_count'),
            ExportColumn::make('deadline'),
            ExportColumn::make('published_at'),
            ExportColumn::make('deleted_at'),
            ExportColumn::make('created_at'),
            ExportColumn::make('updated_at'),
            ExportColumn::make('closed_at'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your job vacancy export has completed and ' . Number::format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . Number::format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
