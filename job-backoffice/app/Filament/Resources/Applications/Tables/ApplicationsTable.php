<?php

namespace App\Filament\Resources\Applications\Tables;

use App\Models\Application;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;

class ApplicationsTable
{
  public static function configure(Table $table): Table
  {
    return $table
      ->columns([
        TextColumn::make('jobSeeker.name')
          ->label("Applicant Name")
          ->searchable()
          ->sortable(),
        TextColumn::make('job.title')
          ->label("Job Title")
          ->searchable()
          ->sortable(),
        TextColumn::make('company.name')
          ->label("Company Name")
          ->searchable()
          ->sortable(),
        TextColumn::make('status')
          ->badge()
          ->color(fn($state): string => match ($state) {
            'new' => 'primary',
            'reviewing' => 'info',
            'shortlisted' => 'warning',
            'interview' => 'warning',
            'offer' => 'info',
            'hired' => 'success',
            'rejected' => 'danger',
            'withdraw' => 'gray',
          })
          ->label("Status")
          ->searchable()
          ->sortable(),
        TextColumn::make('aiGeneratedScore')
          ->label("AI Score")
          ->suffix("%")
          ->searchable()
          ->sortable(),
        IconColumn::make('is_read')
          ->boolean()
          ->label("Read")
          ->searchable()
          ->sortable(),
        TextColumn::make('created_at')
          ->label("Applied At")
          ->date('d, M Y')
          ->searchable()
          ->sortable(),
      ])
      ->filters([
        SelectFilter::make('status')
          ->options(Application::STATUS_OPTIONS),
        SelectFilter::make('interview_stage')
          ->options(Application::APPLICATION_STAGE),
        SelectFilter::make('company_id')
          ->relationship('company', 'name')
          ->label('Company')
          ->searchable()
          ->preload(),
        SelectFilter::make('job_id')
          ->relationship('job', 'title')
          ->label('Job')
          ->searchable()
          ->preload(),
        SelectFilter::make('is_read')
          ->options([
            '1' => 'Read',
            '0' => 'Unread',
          ]),
        Filter::make('created_at')
          ->label('Date Applied')
          ->form([
            DatePicker::make('created_from')
              ->label('From Date')
              ->native(false),
            DatePicker::make('created_until')
              ->label('Until Date')
              ->native(false),
          ])
          ->query(function (Builder $query, array $data) {
            return $query
              ->when(
                $data['created_from'] ?? null,
                fn(Builder $q, $val) => $q->whereDate('created_at', '>=', $val)
              )
              ->when(
                $data['created_until'] ?? null,
                fn(Builder $q, $val) => $q->whereDate('created_at', '<=', $val)
              );
          })
          ->indicateUsing(function (array $data): array {
            $indicators = [];
            if ($data['created_from'] ?? null)
              $indicators[] = 'From: ' . Carbon::parse($data['created_from'])->format('d, M Y');
            if ($data['created_until'] ?? null)
              $indicators[] = 'Until: ' . Carbon::parse($data['created_until'])->format('d, M Y');
            return $indicators;
          }),

        TrashedFilter::make(),
      ])
      ->filtersLayout(FiltersLayout::AboveContentCollapsible)
      ->filtersTriggerAction(
        fn(Action $action) => $action->button()->label('Filters'),
      )
      ->recordActions([
        EditAction::make(),
      ])
      ->toolbarActions([
        BulkActionGroup::make([
          DeleteBulkAction::make(),
          ForceDeleteBulkAction::make(),
          RestoreBulkAction::make(),
        ]),
      ]);
  }
}
