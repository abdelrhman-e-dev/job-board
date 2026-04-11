<?php

namespace App\Filament\Resources\Applications\Tables;

use App\Models\Application;
use App\Models\Interview;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Placeholder;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
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
        TrashedFilter::make(),
        SelectFilter::make('status')
          ->options(Application::STATUS_OPTIONS),
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

      ])
      ->filtersLayout(FiltersLayout::AboveContentCollapsible)
      ->filtersTriggerAction(
        fn(Action $action) => $action->button()->label('Filters'),
      )
      ->recordActions([
        ViewAction::make()
          ->modalHeading(fn($record) => "Application of {$record->jobSeeker->name} for {$record->job->title}")
          ->modalWidth('7xl')
          ->form([
            // ─── Header Summary Banner
            Section::make()
              ->schema([
                Section::make()
                  ->schema([
                    Grid::make(3)
                      ->schema([
                        TextEntry::make('job_seeker_name')
                          ->state(fn($record) => $record->jobSeeker->name)
                          ->label('Applicant Name'),
                        TextEntry::make('job_title')
                          ->state(fn($record) => $record->job->title)
                          ->label('Job Title'),
                        TextEntry::make('company_name')
                          ->state(fn($record) => $record->company->name)
                          ->label('Company Name'),
                        TextEntry::make('status')
                          ->state(fn($record) => $record->status)
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
                          ->label('Status'),
                        TextEntry::make('ai_generated_score')
                          ->state(fn($record) => $record->aiGeneratedScore)
                          ->label('AI Score')
                          ->placeholder('No AI score available'),
                        TextEntry::make('created_at')
                          ->state(fn($record) => $record->created_at)
                          ->date('d, M Y')
                          ->label('Applied At'),
                      ])
                  ]),
                Section::make('Application Overview')
                  ->schema([
                    Grid::make(3)
                      ->schema([
                        TextEntry::make('aiGeneratedScore')
                          ->label('AI Score')
                          ->suffix('%')
                          ->numeric()
                          ->placeholder('No AI score available'),
                        TextEntry::make('ai_feedback')
                          ->label('AI Feedback')
                          ->placeholder('No AI feedback available'),
                        TextEntry::make('reviews')
                          ->label('Reviewer Name')
                          ->placeholder('No reviewer available')
                          ->getStateUsing(
                            fn($record) => $record->reviews
                              ->map(fn($review) => $review->reviewer->name . ' - ' . $review->reviewer->role->role_name)
                              ->implode(', ')
                          ),
                        TextEntry::make('feedback')
                          ->label('Feedback')
                          ->placeholder('No feedback available'),
                        TextEntry::make('is_read')
                          ->icon(fn($state) => $state ? 'heroicon-o-eye' : 'heroicon-o-eye-slash')
                          ->iconColor(fn($state): string => match ($state) {
                            1 => 'success',
                            0 => 'danger',
                          })
                          ->formatStateUsing(fn() => '')
                          ->label('Read'),
                        TextEntry::make('read_at')
                          ->label('Read At')
                          ->placeholder('Not read yet')
                          ->date('d, M Y'),

                      ])
                  ])->collapsed(),
                Section::make('Applicant  Info')
                  ->schema([
                    Grid::make(4)
                      ->schema([
                        TextEntry::make('jobSeeker.name')
                          ->label('Name'),
                        TextEntry::make('jobSeeker.email')
                          ->label('Email'),
                        TextEntry::make('jobSeeker.phone')
                          ->label('Phone'),
                        TextEntry::make('jobSeeker.location')
                          ->label('Location')
                          ->state(fn($record) => $record->jobSeeker->city . ', ' . $record->jobSeeker->country),
                      ])
                  ])->collapsed(),
                Section::make('Job & Company Info')
                  ->schema([
                    Grid::make(3)
                      ->schema([
                        TextEntry::make('job.title')
                          ->label('Job Title'),
                        TextEntry::make('job.type')
                          ->label('Job Type'),
                        TextEntry::make('job.location')
                          ->label('Location'),
                        TextEntry::make('job.jobCategory.name')
                          ->placeholder('No category available')
                          ->label('Department'),
                        TextEntry::make('company.name')
                          ->label('Company'),
                        TextEntry::make('company.industry')
                          ->label('Industry'),
                      ])
                  ])->collapsed(),
              ])
          ]),
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
