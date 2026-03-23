<?php

namespace App\Filament\Resources\JobVacancies\Tables;

use App\Models\Company;
use App\Models\JobVacancy;
use App\Filament\Exports\JobVacancyExporter;
use Filament\Actions\Action;
use Filament\Actions\ExportAction;
use Filament\Actions\ExportBulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\HtmlString;
use PhpParser\Node\Stmt\Label;

class JobVacanciesTable
{
  public static function configure(Table $table): Table
  {
    return $table
      ->columns([
        TextColumn::make('title')
          ->searchable()
          ->sortable()
          ->weight('medium'),
        TextColumn::make('company.name')
          ->label('Company')
          ->searchable(),
        TextColumn::make('jobCategory.name')
          ->label('Category')
          ->badge()
          ->searchable()
          ->sortable(),
        TextColumn::make('type')
          ->badge()
          ->sortable(),
        TextColumn::make('level')
          ->badge()
          ->sortable(),
        TextColumn::make('status')
          ->badge()
          ->sortable(),
        TextColumn::make('applications_count')
          ->label('Applications')
          ->counts('applications')
          ->numeric()
          ->sortable(),
      ])
      ->filters([
        // ── Group 1: Select filters ───────────────────────────────────────────
        SelectFilter::make('status')
          ->options([
            'draft' => 'Draft',
            'active' => 'Active',
            'closed' => 'Closed',
            'expired' => 'Expired',
            'blocked' => 'Blocked',
            'archive' => 'Archive',
          ]),
        SelectFilter::make('category_id')
          ->relationship('jobCategory', 'name')
          ->label('Category')
          ->searchable()
          ->preload(),
        SelectFilter::make('type')
          ->label('Job Type')
          ->options([
            'full-time' => 'Full Time',
            'part-time' => 'Part Time',
            'contract' => 'Contract',
            'temporary' => 'Temporary',
            'internship' => 'Internship',
            'other' => 'Other',
          ]),
        SelectFilter::make('level')
          ->label('Experience Level')
          ->options([
            'entry' => 'Entry Level',
            'mid' => 'Mid Level',
            'senior' => 'Senior Level',
            'lead' => 'Lead Level',
            'director' => 'Director Level',
            'executive' => 'Executive Level',
          ]),
        SelectFilter::make('location')
          ->label('Location')
          ->options(
            fn() => JobVacancy::query()
              ->whereNotNull('location')
              ->distinct()
              ->orderBy('location')
              ->pluck('location', 'location')
              ->toArray()
          )
          ->searchable(),
        // ── Group 2: Salary range ─────────────────────────────────────────────
        Filter::make('salary_range')
          ->label('Salary Range')
          ->form([
            TextInput::make('salary_min')
              ->label('Min Salary')
              ->numeric()
              ->placeholder('e.g. 1000'),
            TextInput::make('salary_max')
              ->label('Max Salary')
              ->numeric()
              ->placeholder('e.g. 5000'),
          ])
          ->query(function (Builder $query, array $data) {
            return $query
              ->when(
                $data['salary_min'] ?? null,
                fn(Builder $q, $val) => $q->where('salary_max', '>=', $val)
              )
              ->when(
                $data['salary_max'] ?? null,
                fn(Builder $q, $val) => $q->where('salary_min', '<=', $val)
              );
          })
          ->indicateUsing(function (array $data): array {
            $indicators = [];
            if ($data['salary_min'] ?? null)
              $indicators[] = 'Min salary: ' . number_format($data['salary_min']);
            if ($data['salary_max'] ?? null)
              $indicators[] = 'Max salary: ' . number_format($data['salary_max']);
            return $indicators;
          }),
        // ── Group 3: Posting date range ───────────────────────────────────────
        Filter::make('published_at')
          ->label('Posting Date')
          ->form([
            DatePicker::make('published_from')
              ->label('From Date')
              ->native(false),
            DatePicker::make('published_until')
              ->label('Until Date')
              ->native(false),
          ])
          ->query(function (Builder $query, array $data) {
            return $query
              ->when(
                $data['published_from'] ?? null,
                fn(Builder $q, $val) => $q->whereDate('published_at', '>=', $val)
              )
              ->when(
                $data['published_until'] ?? null,
                fn(Builder $q, $val) => $q->whereDate('published_at', '<=', $val)
              );
          })
          ->indicateUsing(function (array $data): array {
            $indicators = [];
            if ($data['published_from'] ?? null)
              $indicators[] = 'Posted from: ' . $data['published_from'];
            if ($data['published_until'] ?? null)
              $indicators[] = 'Posted until: ' . $data['published_until'];
            return $indicators;
          }),
        // ── Group 4: Application count ────────────────────────────────────────
        Filter::make('applications_count')
          ->label('Applications')
          ->form([
            Select::make('applications_operator')
              ->label('Condition')
              ->options([
                '>=' => 'At least',
                '<=' => 'At most',
                '=' => 'Exactly',
              ])
              ->default('>='),
            TextInput::make('applications_value')
              ->label('Applications Count')
              ->numeric()
              ->placeholder('e.g. 10'),
          ])
          ->query(function (Builder $query, array $data) {
            if (filled($data['applications_value'] ?? null) && filled($data['applications_operator'] ?? null)) {
              $query->has('applications', $data['applications_operator'], (int) $data['applications_value']);
            }
            return $query;
          })
          ->indicateUsing(function (array $data): ?string {
            if (filled($data['applications_value'] ?? null)) {
              $label = match ($data['applications_operator'] ?? '>=') {
                '>=' => 'At least',
                '<=' => 'At most',
                '=' => 'Exactly',
                default => '',
              };
              return "Applications: {$label} {$data['applications_value']}";
            }
            return null;
          }),
      ])
      ->filtersLayout(FiltersLayout::AboveContentCollapsible)
      ->filtersTriggerAction(
        fn(Action $action) => $action->button()->label('Filters'),
      )
      ->actions([
        ViewAction::make()
          ->modalHeading(fn($record) => "#{$record->id} — {$record->title}")
          ->modalWidth('7xl')
          ->form([

            // ─── Header Summary Banner ────────────────────────────────────────────────
            Section::make()
              ->schema([
                Grid::make(4)
                  ->schema([
                    Placeholder::make('_status_badge')
                      ->label('Status')
                      ->content(fn($record) => new HtmlString(
                        '<span class="fi-badge rounded-md px-2 py-1 text-sm font-semibold ' .
                        match ($record->status) {
                          'published' => 'bg-success-100 text-success-800',
                          'draft' => 'bg-gray-100 text-gray-700',
                          'closed' => 'bg-danger-100 text-danger-800',
                          'paused' => 'bg-warning-100 text-warning-800',
                          default => 'bg-gray-100 text-gray-600',
                        } . '">' . ucfirst($record->status) . '</span>'
                      )),
                    Placeholder::make('_slug')
                      ->label('Slug')
                      ->content(fn($record) => $record->slug ?? '—'),
                    Placeholder::make('_is_featured')
                      ->label('Featured')
                      ->content(fn($record) => new HtmlString(
                        $record->is_featured
                        ? '<span class="text-warning-600 font-semibold">⭐ Featured</span>'
                        : '<span class="text-gray-400">No</span>'
                      )),
                    Placeholder::make('_is_remote')
                      ->label('Remote')
                      ->content(fn($record) => new HtmlString(
                        $record->is_remote
                        ? '<span class="text-success-600 font-semibold">✓ Remote Allowed</span>'
                        : '<span class="text-gray-400">On-site Only</span>'
                      )),
                  ]),
              ]),

            // ─── Job Information ──────────────────────────────────────────────────────
            Section::make('Job Information')
              ->schema([
                Grid::make(4)
                  ->schema([
                    Placeholder::make('title')
                      ->label('Job Title')
                      ->content(fn($record) => $record->title),

                    Placeholder::make('company')
                      ->label('Company')
                      ->content(fn($record) => new HtmlString(
                        '<a href="' . route('filament.admin.resources.companies.edit', $record->company_id) . '" class="text-primary-600 underline">'
                        . e($record->company->name ?? 'N/A') . '</a>'
                      )),

                    Placeholder::make('category')
                      ->label('Category')
                      ->content(fn($record) => $record->jobCategory->name ?? 'N/A'),

                    Placeholder::make('posted_by')
                      ->label('Posted By')
                      ->content(
                        fn($record) => $record->creator
                        ? "{$record->creator->name} ({$record->creator->role->role_name})"
                        : 'N/A'
                      ),
                  ]),
              ])
              ->collapsible(),

            // ─── Job Details ──────────────────────────────────────────────────────────
            Section::make('Job Details')
              ->schema([
                Grid::make(4)
                  ->schema([
                    Placeholder::make('type')
                      ->label('Employment Type')
                      ->content(fn($record) => $record->type),

                    Placeholder::make('level')
                      ->label('Experience Level')
                      ->content(fn($record) => $record->level),

                    Placeholder::make('location')
                      ->label('Location')
                      ->content(fn($record) => $record->location),

                    Placeholder::make('industry')
                      ->label('Industry')
                      ->content(fn($record) => $record->company->industry ?? '—'),
                    Placeholder::make('education')
                      ->label('Education Required')
                      ->content(fn($record) => $record->education ?? '—'),
                    Placeholder::make('experience_years')
                      ->label('Years of Experience')
                      ->content(fn($record) => $record->experience_years
                        ? "{$record->experience_years} year(s)"
                        : '—'),

                    Placeholder::make('skills_tags')
                      ->label('Skills / Tags')
                      ->content(fn($record) => new HtmlString(
                        collect($record->skills ?? [])->map(
                          fn($skill) =>
                          "<span class='fi-badge rounded-full px-2 py-0.5 text-xs bg-primary-100 text-primary-800 mr-1'>{$skill->skill->name}</span>"
                        )->implode('')
                      )),
                  ]),
              ])
              ->collapsible()
              ->collapsed(),

            // ─── Salary Information ───────────────────────────────────────────────────
            Section::make('Salary Information')
              ->schema([
                Grid::make(4)
                  ->schema([
                    Placeholder::make('salary_min')
                      ->label('Minimum Salary')
                      ->content(fn($record) => $record->salary_currency . ' ' . number_format($record->salary_min ?? 0)),

                    Placeholder::make('salary_max')
                      ->label('Maximum Salary')
                      ->content(fn($record) => $record->salary_currency . ' ' . number_format($record->salary_max ?? 0)),

                    Placeholder::make('salary_currency')
                      ->label('Currency')
                      ->content(fn($record) => $record->salary_currency ?? 'USD'),

                    Placeholder::make('salary_period')
                      ->label('Pay Period')
                      ->content(fn($record) => ucfirst($record->salary_period ?? 'monthly')),
                  ]),
              ])
              ->collapsible()
              ->collapsed(),

            // ─── Description & Requirements ───────────────────────────────────────────
            Section::make('Description & Requirements')
              ->schema([
                Grid::make(2)
                  ->schema([
                    Placeholder::make('description')
                      ->label('Description')
                      ->content(fn($record) => new HtmlString(
                        str($record->description ?? '')->markdown()
                      )),
                    Placeholder::make('requirements')
                      ->label('Requirements')
                      ->content(fn($record) => new HtmlString(
                        str($record->requirements ?? '')->markdown()
                      )),
                    Placeholder::make('screening_questions')
                      ->label('Screening Questions')
                      ->content(function ($record) {
                        $questions = $record->screening_questions;
                        if (empty($questions) || !is_array($questions))
                          return '—';
                        return new HtmlString(
                          collect($questions)
                            ->map(function ($answer, $question) {
                              return sprintf(
                                '<div class="mb-2 border-b border-gray-100 pb-2">
              <span class="text-sm font-medium">%s</span>
              <span class="text-gray-400 text-sm">: </span>
              <span class="text-gray-600 text-sm">%s</span>
            </div>',
                                e((string) $question),
                                e((string) $answer)
                              );
                            })
                            ->implode('')
                        );
                      }),
                  ]),
              ])
              ->collapsible()
              ->collapsed(),

            // ─── Applications Overview (Admin Insight) ────────────────────────────────
            Section::make('Applications Overview')
              ->schema([
                Grid::make(8)
                  ->schema([
                    Placeholder::make('_apps_total')
                      ->label('Total Applications')
                      ->content(fn($record) => number_format($record->applications_count ?? 0))->columnSpanFull(),

                    Placeholder::make('_apps_new')
                      ->label('New')
                      ->content(fn($record) => number_format(
                        $record->applications()->where('status', 'new')->count()
                      )),
                    Placeholder::make('_apps_pending')
                      ->label('Pending Review')
                      ->content(fn($record) => number_format(
                        $record->applications()->where('status', 'reviewing')->count()
                      )),

                    Placeholder::make('_apps_shortlisted')
                      ->label('Shortlisted')
                      ->content(fn($record) => number_format(
                        $record->applications()->where('status', 'shortlisted')->count()
                      )),
                    Placeholder::make('_apps_interview')
                      ->label('Interview')
                      ->content(fn($record) => number_format(
                        $record->applications()->where('status', 'interview')->count()
                      )),
                    Placeholder::make('_apps_offer')
                      ->label('Offer')
                      ->content(fn($record) => number_format(
                        $record->applications()->where('status', 'offer')->count()
                      )),

                    Placeholder::make('_apps_hired')
                      ->label('Hired')
                      ->content(fn($record) => number_format(
                        $record->applications()->where('status', 'hired')->count()
                      )),
                    Placeholder::make('_apps_rejected')
                      ->label('Rejected')
                      ->content(fn($record) => number_format(
                        $record->applications()->where('status', 'rejected')->count()
                      )),
                    Placeholder::make('_apps_withdraw')
                      ->label('Withdraw')
                      ->content(fn($record) => number_format(
                        $record->applications()->where('status', 'withdraw')->count()
                      )),
                  ]),
              ])
              ->collapsible()
              ->collapsed(),
            // ─── Statistics & Engagement ──────────────────────────────────────────────
            Section::make('Statistics & Engagement')
              ->schema([
                Grid::make(4)
                  ->schema([
                    Placeholder::make('views_count')
                      ->label('Total Views')
                      ->content(fn($record) => number_format($record->views_count ?? 0)),

                    Placeholder::make('_click_rate')
                      ->label('Apply Click Rate')
                      ->content(fn($record) => $record->views_count
                        ? round(($record->applications_count / $record->views_count) * 100, 2) . '%'
                        : '—'),

                    Placeholder::make('_saved_count')
                      ->label('Bookmarked')
                      ->content(fn($record) => number_format($record->savedJobs->count() ?? 0)),

                    Placeholder::make('deadline')
                      ->label('Application Deadline')
                      ->content(fn($record) => $record->deadline
                        ? $record->deadline->format('d M Y, H:i')
                        : '—'),
                  ]),
              ])
              ->collapsible()
              ->collapsed(),

            // ─── Moderation & Compliance (Admin Only) ────────────────────────────────
            Section::make('Moderation & Compliance')
              ->schema([
                Grid::make(5)
                  ->schema([
                    Placeholder::make('approved_by')
                      ->label('Approved By')
                      ->content(fn($record) => $record->approvedBy?->name ?? '—'),
                    Placeholder::make('_approved_at')
                      ->label('Approved At')
                      ->content(fn($record) => $record->approved_at?->format('d M Y, H:i') ?? '—'),
                    Placeholder::make('flags_count')
                      ->label('User Reports / Flags')
                      ->content(fn($record) => new HtmlString(
                        ($record->flags_count ?? 0) > 0
                        ? '<span class="text-danger-600 font-semibold">' . $record->flags_count . ' report(s)</span>'
                        : '<span class="text-gray-400">None</span>'
                      )),
                    Placeholder::make('visibility')
                      ->label('Visibility')
                      ->content(fn($record) => ucfirst($record->visibility ?? 'public')),
                    Placeholder::make('source')
                      ->label('Listing Source')
                      ->content(fn($record) => ucfirst($record->source ?? 'manual')),
                  ]),
              ])
              ->collapsible()
              ->collapsed(),

            // ─── Timestamps ───────────────────────────────────────────────────────────
            Section::make('Timestamps')
              ->schema([
                Grid::make(4)
                  ->schema([
                    Placeholder::make('published_at')
                      ->label('Published At')
                      ->content(fn($record) => $record->published_at?->format('d M Y, H:i') ?? '—'),

                    Placeholder::make('created_at')
                      ->label('Created At')
                      ->content(fn($record) => $record->created_at?->format('d M Y, H:i') ?? '—'),

                    Placeholder::make('updated_at')
                      ->label('Last Updated')
                      ->content(fn($record) => $record->updated_at?->format('d M Y, H:i') ?? '—'),

                    Placeholder::make('deleted_at')
                      ->label('Deleted At')
                      ->content(fn($record) => $record->deleted_at
                        ? new HtmlString('<span class="text-danger-600">' . $record->deleted_at->format('d M Y, H:i') . '</span>')
                        : "—"),
                  ]),
              ])
              ->collapsible()
              ->collapsed(),
          ]),

        EditAction::make(),
      ])
      // ->headerActions([
      //   ExportAction::make()
      //     ->exporter(JobVacancyExporter::class)
      // ])
      ->bulkActions([
        BulkActionGroup::make([
          DeleteBulkAction::make(),
          RestoreBulkAction::make(),
          ForceDeleteBulkAction::make(),
          ExportBulkAction::make()
            ->exporter(JobVacancyExporter::class),
        ]),
      ])
      ->defaultSort('created_at', 'desc');
  }
}