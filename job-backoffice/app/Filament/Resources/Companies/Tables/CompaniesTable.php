<?php

namespace App\Filament\Resources\Companies\Tables;

use App\Models\Company;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\Placeholder;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Support\HtmlString;

class CompaniesTable
{
  public static function configure(Table $table): Table
  {
    return $table

      ->columns([
        ImageColumn::make('logo')
          ->disk('public')
          ->circular(),
        TextColumn::make('name')
          ->searchable()
          ->label('Company Name'),
        TextColumn::make('owner.full_name')
          ->label('Owner'),
        TextColumn::make('industry')
          ->label('Industry'),
        TextColumn::make('specialization')
          ->label('Specialization'),
        IconColumn::make('verified')
          ->boolean()
          ->sortable(),
        TextColumn::make('created_at')
          ->label('Jioned At')
          ->dateTime('d, MY')
          ->sortable(),
      ])
      ->filters([
        SelectFilter::make('industry')
          ->options(
            Company::all()->pluck('industry', 'industry')->toArray()
          ),
        SelectFilter::make('industry')
          ->options(
            Company::all()->pluck('industry', 'industry')->toArray()
          ),
        TrashedFilter::make(),
      ])
      ->recordActions([
        ViewAction::make('view_company')
          ->modalHeading('Company Details')
          ->modalWidth('7xl')
          ->mountUsing(function ($record) {
            $record->loadMissing([
              'owner',
              'hiringManagers',
              'recruiters',
              'jobs.jobCategory',
              'jobs.applications',
              'jobs.creator.role',
            ]);

            // fix applications_count per job
            $record->jobs->each(fn($j) => $j->loadCount('applications'));
          })
          ->schema([

            // -------------------------
            // SECTION: Company Overview
            // -------------------------
            Section::make('Company Overview')
              ->icon('heroicon-o-building-office-2')
              ->columns([
                'sm' => 1,
                'md' => 2,
                'xl' => 4,
              ])
              ->schema([
                Placeholder::make('company_name')
                  ->label('Company Name')
                  ->content(fn($record) => $record->name)
                  ->extraAttributes(['class' => 'font-semibold text-lg']),

                Placeholder::make('company_owner')
                  ->label('Owner')
                  ->content(fn($record) => $record->owner?->full_name ?? '-')
                  ->extraAttributes(['class' => 'text-primary-600 font-medium']),

                Placeholder::make('company_industry')
                  ->label('Industry')
                  ->content(fn($record) => $record->industry ?? '-')
                  ->badge(),

                Placeholder::make('company_specialization')
                  ->label('Specialization')
                  ->content(fn($record) => $record->specialization ?? '-')
                  ->badge(),
              ]),

            // -------------------------
            // SECTION: Employees
            // -------------------------
            Section::make('Employees')
              ->icon('heroicon-o-users')
              ->schema([

                Section::make('Owner')
                  ->compact()
                  ->schema([
                    Placeholder::make('owner_info')
                      ->hiddenLabel()
                      ->content(
                        fn($record) =>
                        $record->owner
                        ? "{$record->owner->full_name} ({$record->owner->email})"
                        : 'No owner assigned'
                      ),
                  ]),

                Section::make('Hiring Managers')
                  ->compact()
                  ->collapsible()
                  ->collapsed()
                  ->schema([
                    Placeholder::make('hiring_managers')
                      ->hiddenLabel()
                      ->content(
                        fn($record) =>
                        $record->hiringManagers->isEmpty()
                        ? 'No hiring managers found'
                        : new HtmlString(
                          $record->hiringManagers
                            ->map(fn($m) => "
                                <div class='py-1'>
                                  <span class='font-bold'>{$m->full_name}</span>
                                  <span class='text-red-500'>({$m->email})</span>
                                  <span class='text-xs text-gray-400 ml-2'>
                                    since {$m->created_at?->format('M Y')}
                                  </span>
                                </div>
                              ")
                            ->implode('')
                        )
                      ),
                  ]),

                Section::make('Recruiters')
                  ->compact()
                  ->collapsible()
                  ->collapsed()
                  ->schema([
                    Placeholder::make('recruiters_list')
                      ->hiddenLabel()
                      ->content(
                        fn($record) =>
                        $record->recruiters->isEmpty()
                        ? 'No recruiters found'
                        : new HtmlString(
                          $record->recruiters
                            ->map(fn($r) => "
                                <div class='py-1'>
                                  <span class='font-bold'>{$r->full_name}</span>
                                  <span class='text-gray-500'>({$r->email})</span>
                                  <span class='text-xs text-gray-400 ml-2'>
                                    since {$r->created_at?->format('M Y')}
                                  </span>
                                </div>
                              ")
                            ->implode('')
                        )
                      ),
                  ]),
              ])
              ->collapsible()
              ->collapsed(),

            // -------------------------
            // SECTION: Jobs
            // -------------------------
            Section::make('Jobs')
              ->icon('heroicon-o-briefcase')
              ->schema([

                Section::make('Active Jobs')
                  ->compact()
                  ->collapsible()
                  ->collapsed()
                  ->schema([
                    Placeholder::make('active_jobs')
                      ->hiddenLabel()
                      ->content(
                        fn($record) =>
                        $record->jobs->where('status', 'active')->isEmpty()
                        ? 'No Active Jobs Found'
                        : new HtmlString(
                          $record->jobs->where('status', 'active')
                            ->map(fn($j) => "
                                <div class='py-1'>
                                  <p class='font-bold'>
                                    {$j->title}
                                    <span class='text-xs text-gray-400'>
                                      (Published At {$j->published_at?->format('M Y')})
                                    </span>
                                  </p>
                                </div>
                              ")
                            ->implode('')
                        )
                      ),
                  ]),

                Section::make('Job Posting History')
                  ->compact()
                  ->collapsible()
                  ->collapsed()
                  ->schema([
                    Placeholder::make('job_posting_history')
                      ->hiddenLabel()
                      ->content(
                        fn($record) =>
                        $record->jobs->where('status', '!=', 'active')->isEmpty()
                        ? 'No Job History Found'
                        : new HtmlString(
                          $record->jobs->where('status', '!=', 'active')
                            ->map(fn($j) => "
                                <div class='py-2'>
                                  <p class='font-bold'>{$j->title}</p>
                                  <ol style='padding-left:15px'>
                                    <li>Category: " . ($j->jobCategory?->name ?? '-') . "</li>
                                    <li>Job Type: {$j->type}</li>
                                    <li>Location: {$j->location}</li>
                                    <li>Level: {$j->level}</li>
                                    <li>Status: {$j->status}</li>
                                    <li>Applications: {$j->applications_count}</li>
                                    <li>Posted By: " . ($j->creator?->full_name ?? '-') . " - " . ($j->creator?->role?->role_name ?? '-') . "</li>
                                    <li>Published At: " . ($j->published_at?->format('M d, Y') ?? '-') . "</li>
                                    <li>Deadline: " . ($j->deadline?->format('M d, Y') ?? '-') . "</li>
                                    " . ($j->status === 'closed' ? "<li>Closed At: " . ($j->closed_at?->format('M d, Y') ?? '-') . "</li>" : '') . "
                                  </ol>
                                </div>
                                <br>
                              ")
                            ->implode('')
                        )
                      ),
                  ]),
              ])
              ->collapsible()
              ->collapsed(),

            // -------------------------
            // SECTION: Application Statistics
            // -------------------------
            Section::make('Application Statistics')
              ->icon('heroicon-o-chart-bar')
              ->schema([
                Placeholder::make('application_statistics')
                  ->hiddenLabel()
                  ->content(function ($record) {
                    $applications = $record->jobs->flatMap(fn($j) => $j->applications);

                    $total = $applications->count();
                    $new = $applications->filter(fn($a) => $a->getCurrentStatus() === 'new')->count();
                    $reviewing = $applications->filter(fn($a) => $a->getCurrentStatus() === 'reviewing')->count();
                    $interview = $applications->filter(fn($a) => $a->getCurrentStatus() === 'interview')->count();
                    $offer = $applications->filter(fn($a) => $a->getCurrentStatus() === 'offer')->count();
                    $hired = $applications->filter(fn($a) => $a->getCurrentStatus() === 'hired')->count();
                    $rejected = $applications->filter(fn($a) => $a->getCurrentStatus() === 'rejected')->count();

                    return new HtmlString("
                      <div style='display:grid; grid-template-columns: repeat(7, 1fr); gap:12px; text-align:center;'>
                        <div class='p-3 rounded-lg bg-gray-100'>
                          <div class='text-2xl font-bold'>{$total}</div>
                          <div class='text-xs text-gray-500 mt-1'>Total</div>
                        </div>
                        <div class='p-3 rounded-lg bg-yellow-50'>
                          <div class='text-2xl font-bold text-yellow-600'>{$new}</div>
                          <div class='text-xs text-gray-500 mt-1'>New</div>
                        </div>
                        <div class='p-3 rounded-lg bg-blue-50'>
                          <div class='text-2xl font-bold text-blue-600'>{$reviewing}</div>
                          <div class='text-xs text-gray-500 mt-1'>Reviewing</div>
                        </div>
                        <div class='p-3 rounded-lg bg-purple-50'>
                          <div class='text-2xl font-bold text-purple-600'>{$interview}</div>
                          <div class='text-xs text-gray-500 mt-1'>Interview</div>
                        </div>
                        <div class='p-3 rounded-lg bg-orange-50'>
                          <div class='text-2xl font-bold text-orange-600'>{$offer}</div>
                          <div class='text-xs text-gray-500 mt-1'>Offer</div>
                        </div>
                        <div class='p-3 rounded-lg bg-green-50'>
                          <div class='text-2xl font-bold text-green-600'>{$hired}</div>
                          <div class='text-xs text-gray-500 mt-1'>Hired</div>
                        </div>
                        <div class='p-3 rounded-lg bg-red-50'>
                          <div class='text-2xl font-bold text-red-600'>{$rejected}</div>
                          <div class='text-xs text-gray-500 mt-1'>Rejected</div>
                        </div>
                      </div>
                    ");
                  }),
              ])
              ->collapsible()
              ->collapsed(),

            // -------------------------
            // SECTION: Company Analytics
            // -------------------------
            Section::make('Company Analytics')
              ->icon('heroicon-o-presentation-chart-line')
              ->schema([
                Placeholder::make('company_analytics')
                  ->hiddenLabel()
                  ->content(function ($record) {
                    $jobs = $record->jobs;
                    $applications = $record->jobs->flatMap(fn($j) => $j->applications);

                    $totalJobs = $jobs->count();
                    $totalApps = $applications->count();

                    $hiredApps = $applications
                      ->filter(fn($a) => $a->getCurrentStatus() === 'hired')
                      ->count();

                    $hireRate = $totalApps > 0
                      ? round(($hiredApps / $totalApps) * 100)
                      : 0;

                    return new HtmlString("
                      <div style='display:grid; grid-template-columns: repeat(3, 1fr); gap:16px;'>

                        <div class='p-4 rounded-lg bg-gray-50'>
                          <div class='text-xs text-gray-500 mb-1'>Total Jobs Posted</div>
                          <div class='text-2xl font-bold'>{$totalJobs}</div>
                        </div>

                        <div class='p-4 rounded-lg bg-gray-50'>
                          <div class='text-xs text-gray-500 mb-1'>Total Applications</div>
                          <div class='text-2xl font-bold'>{$totalApps}</div>
                        </div>

                        <div class='p-4 rounded-lg bg-green-50'>
                          <div class='text-xs text-gray-500 mb-1'>Hire Rate</div>
                          <div class='text-2xl font-bold text-green-600'>{$hireRate}%</div>
                          <div class='text-xs text-gray-400'>{$hiredApps} hired out of {$totalApps}</div>
                        </div>
                      </div>
                    ");
                  }),
              ])
              ->collapsible()
              ->collapsed(),

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
