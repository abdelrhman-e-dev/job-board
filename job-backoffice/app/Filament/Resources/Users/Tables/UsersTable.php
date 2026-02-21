<?php

namespace App\Filament\Resources\Users\Tables;

use App\Filament\Resources\Companies\CompanyResource;
use App\Models\Application;
use App\Models\Offer;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Illuminate\Database\Eloquent\Collection;
use Filament\Forms\Components\Placeholder;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Support\HtmlString;

class UsersTable
{
  public static function configure(Table $table): Table
  {
    return $table
      ->columns([
        ImageColumn::make('avatar')
          ->visibility('public')
          ->circular()
          ->defaultImageUrl('https://png.pngtree.com/png-vector/20220719/ourmid/pngtree-color-icon---businessman-icon-color-sign-vectorteamwork-account-admin-photo-image_37961448.jpg'),
        TextColumn::make('full_name')
          ->label('Full Name')
          ->searchable(query: function ($query, $search) {
            $query->where(function ($q) use ($search) {
              $q->where('first_name', 'like', "%{$search}%")
                ->orWhere('last_name', 'like', "%{$search}%");
            });
          })
          ->getStateUsing(fn($record) => $record->full_name),
        TextColumn::make('email')
          ->label('Email address')
          ->limit(10)
          ->searchable(),
        TextColumn::make('role.role_name')
          ->badge()
          ->color(
            fn(string $state): string => match ($state) {
              'system-admin' => 'danger',
              'company-owner' => 'success',
              'hiring-manager' => 'warning',
              'recruiter' => 'gray',
              'job-seeker' => 'info',
              default => 'gray',
            }
          ),
        TextColumn::make('status')
          ->label('Status')
          ->badge()
          ->color(
            fn(string $state): string => match ($state) {
              'Active' => 'success',
              'Inactive' => 'danger',
              default => 'gray',
            }
          )
          ->sortable()
          ->placeholder('—'),
        TextColumn::make('created_at')
          ->label('Created At')
          ->dateTime('d, M Y')
          ->sortable(),
        TextColumn::make('deleted_at')
          ->dateTime()
          ->sortable()
          ->toggleable(isToggledHiddenByDefault: true),
      ])
      ->filters([
        SelectFilter::make('role')
          ->relationship('role', 'role_name'),
        TrashedFilter::make(),
      ])
      ->actions([
        ViewAction::make('viewUser')
          ->modalHeading(fn($record) => $record->full_name)
          ->modalWidth('6xl')
          ->form(
            function ($record) {
              // Job Seeker View
              if ($record->role->role_name == 'job-seeker') {
                return [
                  Section::make('User Information')
                    ->icon('heroicon-o-identification')
                    ->schema([
                      Grid::make(4)
                        ->schema([
                          Placeholder::make('full_name')
                            ->label('Full Name')
                            ->content(fn($record) => $record->full_name),
                          Placeholder::make('email')
                            ->label('Email')
                            ->content(fn($record) => $record->email),
                          Placeholder::make('phone')
                            ->label('Phone')
                            ->content(fn($record) => $record->phone),
                          Placeholder::make('country')
                            ->label('Country')
                            ->content(fn($record) => $record->country),
                        ]),
                    ])
                    ->collapsible(),
                  Section::make('Account Information')
                    ->schema([
                      Grid::make(4)
                        ->schema([
                          Placeholder::make('role_id')
                            ->label('Role')
                            ->content(fn($record) => $record->role->role_name),
                          Placeholder::make('email_verified_at')
                            ->label('Email Verified')
                            ->content(fn($record) => $record->email_verified_at ? 'Yes' : 'No'),
                          Placeholder::make('status')
                            ->label('Status')
                            ->content(fn($record) => $record->status),
                        ]),
                    ])
                    ->collapsible()
                    ->collapsed(),
                  Section::make('Company Information')
                    ->schema([
                      Grid::make(4)
                        ->schema([
                          Placeholder::make('company')
                            ->label('Company')
                            ->content(function ($record) {
                              if ($record->company_id) {
                                return $record->company->name;
                              } else {
                                return 'Not Assigned Yet';
                              }
                            }),
                        ]),
                    ])
                    ->collapsible()
                    ->collapsed(),
                  Section::make('User Applications')
                    ->schema([
                      Grid::make(1)
                        ->schema([
                          Placeholder::make('total_applications')
                            ->label('Total Applications')
                            ->content(fn($record) => $record->applications()->count()),
                          Placeholder::make('applications')
                            ->label('Applications List')
                            ->content(function ($record) {
                              $apps = $record->applications()
                                ->with('job.company')
                                ->latest()
                                ->get();

                              if ($apps->isEmpty()) {
                                return 'No applications found.';
                              }
                              $list = $apps->map(function ($app) {
                                $jobTitle = e($app->job->title ?? 'Unknown Job');
                                $company = e($app->job->company->name ?? 'Unknown Company');
                                $status = ucfirst($app->status);
                                return "
                                <li style='margin-bottom: 8px;'>
                                <strong>{$jobTitle}</strong>
                                <div style='font-size: 13px; color: #6b7280;'>
                                {$company} • {$status} • {$app->created_at->format('M d, Y')}
                                </div>
                                </li>
                                  ";
                              })->implode('');

                              return new HtmlString("
                                <ul style='list-style: none; padding-left: 0;'>
                                {$list}
                                </ul>
                          ");
                            }),

                        ])
                    ])->collapsible()
                    ->collapsed(),
                  Section::make('User Documents')
                    ->schema([
                      Grid::make(1)
                        ->schema([
                          Placeholder::make('total_documents')
                            ->label('Total Documents')
                            ->content(fn($record) => $record->documents()->count())
                        ]),
                      Placeholder::make('documents')
                        ->label('Documents')
                        ->content(function ($record) {
                          $docs = $record->documents()
                            ->with('application')
                            ->with('document_reviews')
                            ->latest()
                            ->get();

                          if ($docs->isEmpty()) {
                            return 'No Documents Uploaded';
                          }

                          $list = $docs->map(function ($doc) {
                            $doc_title = e($doc->file_name ?? 'Unknown Document');
                            $doc_type = e($doc->type ?? 'Unknown Type');

                            // Handle Application
                            $application = $doc->application;
                            $app_details = '';
                            if ($application) {
                              $job_title = e($application->job->title ?? 'Unknown Job');
                              $date = $application->created_at->format('M d, Y');
                              $app_details = "• Applied for: {$job_title} • {$date}";
                            } else {
                              $app_details = "• Not used in application";
                            }

                            // Handle Review
                            $review = $doc->document_reviews->first();
                            $review_html = '';
                            $status_suffix = '';

                            if ($review) {
                              $status = $review->status ?? 'Pending';
                              $score = $review->overall_score ?? 'N/A';
                              $ats = $review->ats_compatibility ?? 'N/A';

                              $status_suffix = " - {$status}";
                              $review_html = "
                            <div style='font-size: 13px; color: #b9bcc2ff;'>
                                Score: {$score} • ATS: {$ats}%
                            </div>";
                            }

                            return "
                        <li style='margin-bottom: 8px;'>
                          <strong>{$doc_title}{$status_suffix}</strong>
                          <div style='font-size: 13px; color: #b9bcc2ff;'>
                            {$doc_type} {$app_details}
                          </div>
                          {$review_html}
                          </li>
                      ";
                          })->implode(' ');

                          return new HtmlString(
                            "<ul style='list-style: none; padding-left: 0;'>{$list}</ul>"
                          );
                        })
                    ])->collapsible()
                    ->collapsed()
                    ->persistCollapsed(),
                ];
              };
              // Company Owner View
              if ($record->role?->role_name === 'company-owner') {
                return [
                  /*
                  |--------------------------------------------------------------------------
                  | Owner Information
                  |--------------------------------------------------------------------------
                  */
                  Section::make('Owner Information')
                    ->icon('heroicon-o-identification')
                    ->schema([
                      // 🔹 Basic Personal Info
                      Grid::make(4)
                        ->schema([
                          Placeholder::make('full_name')
                            ->label('Full Name')
                            ->content(fn($record) => $record->full_name ?? 'N/A'),

                          Placeholder::make('email')
                            ->label('Email')
                            ->content(fn($record) => $record->email ?? 'N/A'),

                          Placeholder::make('phone')
                            ->label('Phone')
                            ->content(fn($record) => $record->phone ?? 'N/A'),

                          Placeholder::make('location')
                            ->label('Location')
                            ->content(
                              fn($record) =>
                              ($record->city && $record->country)
                              ? "{$record->city} - {$record->country}"
                              : 'N/A'
                            ),
                        ]),
                      // 🔹 Role Info
                      Grid::make(4)
                        ->schema([
                          Placeholder::make('company_name')
                            ->label('Company')
                            ->content(fn($record) => $record->company?->name ?? 'N/A'),

                          Placeholder::make('role')
                            ->label('Role')
                            ->content(fn($record) => ucfirst($record->role?->role_name ?? 'N/A')),

                          Placeholder::make('permissions')
                            ->label('Permissions')
                            ->content(
                              fn($record) =>
                              $record->role?->permissions?->pluck('permission_name')->implode(', ')
                              ?? 'N/A'
                            ),
                          Placeholder::make('status')
                            ->label('Status')
                            ->content(fn($record) => ucfirst($record->status ?? 'N/A')),
                        ]),
                    ])
                    ->collapsible(),
                  /*
                  |--------------------------------------------------------------------------
                  | Company Information
                  |--------------------------------------------------------------------------
                  */
                  Section::make('Company Information')
                    ->icon('heroicon-m-building-office-2')
                    ->schema([
                      // 🔹 Basic Info
                      Grid::make(3)
                        ->schema([
                          Placeholder::make('company_name_display')
                            ->label('Company Name')
                            ->content(fn($record) => $record->company?->name ?? 'N/A'),
                          Placeholder::make('industry')
                            ->label('Industry')
                            ->content(fn($record) => $record->company?->industry ?? 'N/A'),
                          Placeholder::make('size')
                            ->label('Company Size')
                            ->content(fn($record) => $record->company?->size ?? 'N/A'),
                        ]),
                      // 🔹 Contact
                      Grid::make(3)
                        ->schema([
                          Placeholder::make('contact_email')
                            ->label('Email')
                            ->content(fn($record) => $record->company?->contact_email ?? 'N/A'),
                          Placeholder::make('contact_phone')
                            ->label('Phone')
                            ->content(fn($record) => $record->company?->contact_phone ?? 'N/A'),
                          Placeholder::make('website')
                            ->label('Website')
                            ->content(fn($record) => $record->company?->website ?? 'N/A'),
                        ]),
                      // 🔹 Location
                      Grid::make(3)
                        ->schema([
                          Placeholder::make('country')
                            ->label('Country')
                            ->content(fn($record) => $record->company?->country ?? 'N/A'),
                          Placeholder::make('city')
                            ->label('City')
                            ->content(fn($record) => $record->company?->city ?? 'N/A'),
                          Placeholder::make('address')
                            ->label('Address')
                            ->content(fn($record) => $record->company?->address ?? 'N/A'),
                        ]),

                      // 🔹 Business Details
                      Grid::make(3)
                        ->schema([
                          Placeholder::make('founded_year')
                            ->label('Founded')
                            ->content(fn($record) => $record->company?->founded_year ?? 'N/A'),
                          Placeholder::make('specialization')
                            ->label('Specialization')
                            ->content(fn($record) => $record->company?->specialization ?? 'N/A'),
                          Placeholder::make('job_posting_limit')
                            ->label('Job Posting Limit')
                            ->content(fn($record) => $record->company?->job_posting_limit ?? 'N/A'),
                        ]),

                      // 🔹 Status
                      Grid::make(3)
                        ->schema([
                          Placeholder::make('company_status')
                            ->label('Status')
                            ->content(fn($record) => ucfirst($record->company?->status ?? 'N/A')),
                          Placeholder::make('approved_at')
                            ->label('Approved At')
                            ->content(
                              fn($record) =>
                              optional($record->company?->approved_at)?->format('Y-m-d') ?? 'N/A'
                            ),
                          Placeholder::make('rejected_at')
                            ->label('Rejected At')
                            ->content(
                              fn($record) =>
                              optional($record->company?->rejected_at)?->format('Y-m-d') ?? 'N/A'
                            ),
                        ]),
                    ])
                    ->collapsible()
                    ->collapsed(),
                  /*
                  |--------------------------------------------------------------------------
                  | Jobs Posted Information
                  |--------------------------------------------------------------------------
                  */
                  Section::make('Recent Jobs Posted')
                    ->icon('heroicon-o-briefcase')
                    ->schema([
                      Grid::make(1)
                        ->schema([
                          Placeholder::make('last_job_posted')
                            ->label('Last Job Posted')
                            ->content(
                              fn($record) =>
                              optional(
                                $record->company?->jobs()->latest()->first()
                              )?->created_at?->format('Y-m-d') ?? '—'
                            ),

                          Placeholder::make('jobs_posted')
                            ->content(function ($record) {
                              $jobs = $record->company?->jobs()
                                ->with(['applications.jobSeeker'])
                                ->withCount('applications')
                                ->latest()
                                ->take(2)
                                ->get();
                              if ($jobs->isEmpty()) {
                                return 'No jobs posted yet.';
                              }
                              $list = $jobs->map(function ($job) {

                                $lastApplication = $job->applications->sortByDesc('created_at')->first();

                                $jobTitle = e($job->title);
                                $applicationsCount = $job->applications_count;

                                if (!$lastApplication) {
                                  return "
                            <li style='padding:10px 0; border-bottom:1px solid #eee;'>
                                <strong>{$jobTitle}</strong><br>
                                <span>{$applicationsCount} applications</span><br>
                                <em>No applications yet.</em>
                            </li>
                        ";
                                }

                                $applicantName = e($lastApplication->jobSeeker->full_name ?? 'Unknown');
                                $appliedDate = $lastApplication->created_at->format('Y-m-d');
                                $status = ucfirst($lastApplication->status);

                                return "
                        <li style='padding:10px 0; border-bottom:1px solid #eee;'>
                            <strong>{$jobTitle}</strong><br>
                            <span>{$applicationsCount} applications</span><br>
                            <small>
                                {$applicantName} applied on {$appliedDate}<br>
                                Status: {$status}
                            </small>
                        </li>
                    ";
                              })->implode('');
                              // job data -> has number of applications -> last 2 application data
                              return new HtmlString(
                                "
                              <ul style='list-style: none; padding-left: 0;'>
                                {$list}
                              </ul>
                                "
                              );


                            }),
                        ])
                    ])
                    ->collapsible()
                    ->collapsed(),
                  /*
                  |--------------------------------------------------------------------------
                  | Company Activities 
                  |--------------------------------------------------------------------------
                  */
                  Section::make('Company Activity')
                    ->icon('heroicon-o-chart-bar')
                    ->schema([
                      Grid::make(5)->schema([
                        Placeholder::make('jobs_count')
                          ->label('Jobs Posted')
                          ->content(
                            fn($record) =>
                            $record->company?->jobs()->count() ?? 0
                          ),

                        Placeholder::make('active_jobs')
                          ->label('Active Jobs')
                          ->content(
                            fn($record) =>
                            $record->company?->jobs()
                              ->where('status', 'active')
                              ->count() ?? 0
                          ),

                        Placeholder::make('applications_count')
                          ->label('Applications')
                          ->content(
                            fn($record) =>
                            $record->company?->jobs()
                              ->withCount('applications')
                              ->get()
                              ->sum('applications_count')
                          ),
                        Placeholder::make('hiring_managers')
                          ->label('Hiring Managers')
                          ->content(
                            fn($record) =>
                            $record->company?->users()
                              ->whereHas('role', fn($query) => $query->where('role_name', 'hiring-manager'))
                              ->count()
                          ),
                        Placeholder::make('recruiters')
                          ->label('Recruiters')
                          ->content(
                            fn($record) =>
                            $record->company?->users()
                              ->whereHas('role', fn($query) => $query->where('role_name', 'recruiter'))
                              ->count()
                          ),
                      ]),
                    ])
                    ->collapsible()
                    ->collapsed(),
                  /*
                  |--------------------------------------------------------------------------
                  | Account Security 
                  |--------------------------------------------------------------------------
                  */
                  Section::make('Account Security')
                    ->icon('heroicon-o-shield-check')
                    ->schema([
                      Grid::make(4)->schema([
                        Placeholder::make('last_login')
                          ->label('Last Login')
                          ->content(
                            fn($record) =>
                            $record->last_login_at?->diffForHumans() ?? 'Never'
                          ),

                        Placeholder::make('email_verified')
                          ->label('Email Verified')
                          ->content(
                            fn($record) =>
                            $record->email_verified_at ? 'Yes' : 'No'
                          ),

                        Placeholder::make('joined_at')
                          ->label('Joined')
                          ->content(
                            fn($record) =>
                            $record->created_at?->format('Y-m-d')
                          ),

                        Placeholder::make('owner_status')
                          ->label('Account Status')
                          ->content(
                            fn($record) =>
                            ucfirst($record->status ?? 'N/A')
                          ),
                      ]),
                    ])
                    ->collapsible()
                    ->collapsed(),

                ];
              }
              // Hiring Manager View
              if ($record->role->role_name == 'hiring-manager') {
                return [
                  /*
                  |--------------------------------------------------------------------------
                  | Hiring Manger Information
                  |--------------------------------------------------------------------------
                  */
                  Section::make('Hiring Manager Profile')
                    ->icon('heroicon-o-identification')
                    ->schema([

                      Grid::make(4)->schema([
                        Placeholder::make('full_name')
                          ->label('Full Name')
                          ->content(fn($record) => $record->full_name ?? 'N/A'),

                        Placeholder::make('email')
                          ->label('Email')
                          ->content(fn($record) => $record->email ?? 'N/A'),

                        Placeholder::make('phone')
                          ->label('Phone')
                          ->content(fn($record) => $record->phone ?? 'N/A'),

                        Placeholder::make('location')
                          ->label('Location')
                          ->content(
                            fn($record) =>
                            ($record->city && $record->country)
                            ? "{$record->city} - {$record->country}"
                            : 'N/A'
                          ),
                      ]),

                      Grid::make(4)->schema([
                        Placeholder::make('role')
                          ->label('Role')
                          ->content(
                            fn($record) =>
                            str_replace('-', ' ', ucfirst($record->role?->role_name)) ?? 'N/A'
                          ),

                        Placeholder::make('status')
                          ->label('Status')
                          ->content(fn($record) => ucfirst($record->status ?? 'N/A')),

                        Placeholder::make('permissions')
                          ->label('Permissions')
                          ->content(
                            fn($record) =>
                            $record->role?->permissions?->pluck('permission_name')->implode(', ')
                            ?? 'N/A'
                          ),

                        Placeholder::make('company')
                          ->label('Company')
                          ->content(fn($record) => $record->company?->name ?? 'N/A'),
                      ]),
                    ])
                    ->collapsible(),

                  Section::make('Company Context')
                    ->icon('heroicon-o-building-office')
                    ->schema([

                      Grid::make(4)->schema([
                        Placeholder::make('industry')
                          ->label('Industry')
                          ->content(fn($record) => $record->company?->industry ?? 'N/A'),

                        Placeholder::make('company_size')
                          ->label('Size')
                          ->content(fn($record) => $record->company?->size ?? 'N/A'),

                        Placeholder::make('company_location')
                          ->label('Location')
                          ->content(
                            fn($record) =>
                            ($record->company?->city && $record->company?->country)
                            ? "{$record->company->city}, {$record->company->country}"
                            : 'N/A'
                          ),

                        Placeholder::make('company_status')
                          ->label('Company Status')
                          ->content(
                            fn($record) =>
                            ucfirst($record->company?->status ?? 'N/A')
                          ),
                      ]),

                      Grid::make(4)->schema([
                        Placeholder::make('company_managers')
                          ->label('Hiring Managers')
                          ->content(
                            fn($record) =>
                            $record->company?->users()
                              ->whereHas('role', fn($q) => $q->where('role_name', 'hiring-manager'))
                              ->count()
                          ),

                        Placeholder::make('company_recruiters')
                          ->label('Recruiters')
                          ->content(
                            fn($record) =>
                            $record->company?->users()
                              ->whereHas('role', fn($q) => $q->where('role_name', 'recruiter'))
                              ->count()
                          ),
                      ]),
                    ])
                    ->collapsible()
                    ->collapsed(),

                  Section::make('Hiring Activity')
                    ->icon('heroicon-o-briefcase')
                    ->schema([

                      Grid::make(4)->schema([
                        Placeholder::make('manager_jobs')
                          ->label('Jobs Created')
                          ->content(fn($record) => $record->jobs()->count()),

                        Placeholder::make('active_jobs')
                          ->label('Active Jobs')
                          ->content(
                            fn($record) =>
                            $record->jobs()->where('status', 'active')->count()
                          ),

                        Placeholder::make('applications_received')
                          ->label('Applications')
                          ->content(
                            fn($record) =>
                            $record->jobs()->withCount('applications')->get()->sum('applications_count')
                          ),

                        Placeholder::make('last_job_posted')
                          ->label('Last Job')
                          ->content(
                            fn($record) =>
                            optional($record->jobs()->latest()->first())?->created_at?->format('Y-m-d') ?? '—'
                          ),
                      ]),
                    ])
                    ->collapsible()
                    ->collapsed(),

                  Section::make('Hiring Performance')
                    ->icon('heroicon-o-chart-bar')
                    ->schema([

                      Grid::make(4)->schema([
                        Placeholder::make('jobs_closed')
                          ->label('Jobs Closed')
                          ->content(
                            fn($record) =>
                            $record->jobs()->where('status', 'closed')->count()
                          ),

                        Placeholder::make('interviews_made')
                          ->label('Interviews Made')
                          ->content(
                            fn($record) =>
                            Application::whereIn('job_id', $record->jobs()->pluck('job_id'))
                              ->where('status', 'interview')
                              ->count()
                          ),
                        Placeholder::make('hires_made')
                          ->label('Hires Made')
                          ->content(
                            fn($record) =>
                            Application::whereIn('job_id', $record->jobs()->pluck('job_id'))
                              ->where('status', 'hired')
                              ->count()
                          ),

                        Placeholder::make('avg_apps_per_job')
                          ->label('Avg Apps / Job')
                          ->content(function ($record) {
                            $jobs = $record->jobs()->withCount('applications')->get();
                            return $jobs->isEmpty() ? '0' : round($jobs->avg('applications_count'), 1);
                          }),

                        Placeholder::make('hire_rate')
                          ->label('Hire Rate')
                          ->content(function ($record) {
                            $jobs = $record->jobs()->count();
                            if ($jobs === 0)
                              return '0%';

                            $hires = Application::whereIn('job_id', $record->jobs()->pluck('job_id'))
                              ->where('status', 'hired')
                              ->count();

                            return round(($hires / $jobs) * 100) . '%';
                          }),
                      ]),
                    ])
                    ->collapsible()
                    ->collapsed(),

                  Section::make('Application Funnel')
                    ->schema([
                      Grid::make(8)->schema([
                        Placeholder::make('apps_new')
                          ->label('New')
                          ->content(
                            fn($record) =>
                            Application::whereIn('job_id', $record->jobs()->pluck('job_id'))
                              ->where('status', 'new')->count()
                          ),

                        Placeholder::make('apps_reviewing')
                          ->label('Reviewing')
                          ->content(
                            fn($record) =>
                            Application::whereIn('job_id', $record->jobs()->pluck('job_id'))
                              ->where('status', 'reviewing')->count()
                          ),

                        Placeholder::make('apps_shortlisted')
                          ->label('Shortlisted')
                          ->content(
                            fn($record) =>
                            Application::whereIn('job_id', $record->jobs()->pluck('job_id'))
                              ->where('status', 'shortlisted')->count()
                          ),

                        Placeholder::make('apps_interview')
                          ->label('Interview')
                          ->content(
                            fn($record) =>
                            Application::whereIn('job_id', $record->jobs()->pluck('job_id'))
                              ->where('status', 'interview')->count()
                          ),

                        Placeholder::make('apps_offer')
                          ->label('Offer')
                          ->content(
                            fn($record) =>
                            Application::whereIn('job_id', $record->jobs()->pluck('job_id'))
                              ->where('status', 'offer')->count()
                          ),

                        Placeholder::make('apps_hired')
                          ->label('Hired')
                          ->content(
                            fn($record) =>
                            Application::whereIn('job_id', $record->jobs()->pluck('job_id'))
                              ->where('status', 'hired')->count()
                          ),

                        Placeholder::make('apps_rejected')
                          ->label('Rejected')
                          ->content(
                            fn($record) =>
                            Application::whereIn('job_id', $record->jobs()->pluck('job_id'))
                              ->where('status', 'rejected')->count()
                          ),

                        Placeholder::make('apps_withdraw')
                          ->label('Withdraw')
                          ->content(
                            fn($record) =>
                            Application::whereIn('job_id', $record->jobs()->pluck('job_id'))
                              ->where('status', 'withdraw')->count()
                          ),
                      ]),
                    ])
                    ->collapsible()
                    ->collapsed(),

                  Section::make('Review Behavior')
                    ->schema([
                      Grid::make(3)->schema([

                        Placeholder::make('unread_apps')
                          ->label('Unread Apps')
                          ->content(
                            fn($record) =>
                            Application::whereIn('job_id', $record->jobs()->pluck('job_id'))
                              ->where('is_read', 0)->count()
                          ),

                        Placeholder::make('never_opened')
                          ->label('Never Opened')
                          ->content(
                            fn($record) =>
                            Application::whereIn('job_id', $record->jobs()->pluck('job_id'))
                              ->whereNull('read_at')->count()
                          ),

                        Placeholder::make('oldest_pending')
                          ->label('Oldest Pending')
                          ->content(function ($record) {
                            $app = Application::whereIn('job_id', $record->jobs()->pluck('job_id'))
                              ->whereIn('status', ['new', 'reviewing'])
                              ->oldest()
                              ->first();

                            return $app ? $app->created_at->diffForHumans() : '—';
                          }),
                      ]),
                    ])
                    ->collapsible()
                    ->collapsed()

                ];
              }
              // Recruiter View
              if ($record->role->role_name === 'recruiter') {

                $company = $record->company;

                $jobIds = $company?->jobs()->pluck('job_id') ?? collect();

                return [

                  /*
                  |--------------------------------------------------------------------------
                  | Recruiter Profile
                  |--------------------------------------------------------------------------
                  */
                  Section::make('Recruiter Profile')
                    ->icon('heroicon-o-identification')
                    ->schema([

                      Grid::make(4)->schema([
                        Placeholder::make('full_name')
                          ->label('Full Name')
                          ->content(fn($record) => $record->full_name ?? 'N/A'),

                        Placeholder::make('email')
                          ->label('Email')
                          ->content(fn($record) => $record->email ?? 'N/A'),

                        Placeholder::make('phone')
                          ->label('Phone')
                          ->content(fn($record) => $record->phone ?? 'N/A'),

                        Placeholder::make('location')
                          ->label('Location')
                          ->content(
                            fn($record) =>
                            ($record->city && $record->country)
                            ? "{$record->city} - {$record->country}"
                            : 'N/A'
                          ),
                      ]),

                      Grid::make(4)->schema([
                        Placeholder::make('role')
                          ->label('Role')
                          ->content(
                            fn($record) =>
                            str_replace('-', ' ', ucfirst($record->role?->role_name)) ?? 'N/A'
                          ),

                        Placeholder::make('status')
                          ->label('Status')
                          ->content(fn($record) => ucfirst($record->status ?? 'N/A')),

                        Placeholder::make('permissions')
                          ->label('Permissions')
                          ->content(
                            fn($record) =>
                            $record->role?->permissions?->pluck('permission_name')->implode(', ')
                            ?? 'N/A'
                          ),

                        Placeholder::make('company')
                          ->label('Company')
                          ->content(fn($record) => $record->company?->name ?? 'N/A'),
                      ]),
                    ])
                    ->collapsible(),

                  /*
                  |--------------------------------------------------------------------------
                  | Company Context
                  |--------------------------------------------------------------------------
                  */
                  Section::make('Company Context')
                    ->icon('heroicon-o-building-office')
                    ->schema([

                      Grid::make(4)->schema([
                        Placeholder::make('industry')
                          ->label('Industry')
                          ->content(fn() => $company?->industry ?? 'N/A'),

                        Placeholder::make('company_size')
                          ->label('Size')
                          ->content(fn() => $company?->size ?? 'N/A'),

                        Placeholder::make('company_location')
                          ->label('Location')
                          ->content(
                            fn() =>
                            ($company?->city && $company?->country)
                            ? "{$company->city}, {$company->country}"
                            : 'N/A'
                          ),

                        Placeholder::make('company_status')
                          ->label('Company Status')
                          ->content(fn() => ucfirst($company?->status ?? 'N/A')),
                      ]),

                      Grid::make(4)->schema([
                        Placeholder::make('company_managers')
                          ->label('Hiring Managers')
                          ->content(
                            fn() =>
                            $company?->users()
                              ->whereHas('role', fn($q) => $q->where('role_name', 'hiring-manager'))
                              ->count() ?? 0
                          ),

                        Placeholder::make('company_recruiters')
                          ->label('Recruiters')
                          ->content(
                            fn() =>
                            $company?->users()
                              ->whereHas('role', fn($q) => $q->where('role_name', 'recruiter'))
                              ->count() ?? 0
                          ),
                      ]),
                    ])
                    ->collapsible()
                    ->collapsed(),

                  /*
                  |--------------------------------------------------------------------------
                  | Hiring Activity
                  |--------------------------------------------------------------------------
                  */
                  Section::make('Hiring Activity')
                    ->icon('heroicon-o-briefcase')
                    ->schema([

                      Grid::make(4)->schema([
                        Placeholder::make('company_jobs')
                          ->label('Company Jobs')
                          ->content(fn() => $company?->jobs()->count() ?? 0),

                        Placeholder::make('active_jobs')
                          ->label('Active Jobs')
                          ->content(
                            fn() =>
                            $company?->jobs()->where('status', 'active')->count() ?? 0
                          ),

                        Placeholder::make('applications_received')
                          ->label('Applications')
                          ->content(
                            fn() =>
                            $company?->jobs()
                              ->withCount('applications')
                              ->get()
                              ->sum('applications_count') ?? 0
                          ),

                        Placeholder::make('last_job_posted')
                          ->label('Last Job')
                          ->content(
                            fn() =>
                            optional($company?->jobs()->latest()->first())
                              ?->created_at?->format('Y-m-d') ?? '—'
                          ),
                      ]),
                    ])
                    ->collapsible()
                    ->collapsed(),

                  /*
                  |--------------------------------------------------------------------------
                  | Hiring Performance
                  |--------------------------------------------------------------------------
                  */
                  Section::make('Hiring Performance')
                    ->icon('heroicon-o-chart-bar')
                    ->schema([

                      Grid::make(5)->schema([
                        Placeholder::make('jobs_closed')
                          ->label('Jobs Closed')
                          ->content(
                            fn() =>
                            $company?->jobs()->where('status', 'closed')->count() ?? 0
                          ),

                        Placeholder::make('interviews_made')
                          ->label('Interviews')
                          ->content(
                            fn() =>
                            Application::whereIn('job_id', $jobIds)
                              ->where('status', 'interview')
                              ->count()
                          ),

                        Placeholder::make('hires_made')
                          ->label('Hires')
                          ->content(
                            fn() =>
                            Application::whereIn('job_id', $jobIds)
                              ->where('status', 'hired')
                              ->count()
                          ),

                        Placeholder::make('avg_apps_per_job')
                          ->label('Avg Apps / Job')
                          ->content(function () use ($company) {
                            $jobs = $company?->jobs()->withCount('applications')->get() ?? collect();
                            return $jobs->isEmpty()
                              ? 0
                              : round($jobs->avg('applications_count'), 1);
                          }),

                        Placeholder::make('hire_rate')
                          ->label('Hire Rate')
                          ->content(function () use ($company, $jobIds) {
                            $jobs = $company?->jobs()->count() ?? 0;
                            if ($jobs === 0)
                              return '0%';

                            $hires = Application::whereIn('job_id', $jobIds)
                              ->where('status', 'hired')
                              ->count();

                            return round(($hires / $jobs) * 100) . '%';
                          }),
                      ]),
                    ])
                    ->collapsible()
                    ->collapsed(),

                  /*
                  |--------------------------------------------------------------------------
                  | Application Funnel
                  |--------------------------------------------------------------------------
                  */
                  Section::make('Application Funnel')
                    ->schema([
                      Grid::make(8)->schema([

                        Placeholder::make('apps_new')
                          ->label('New')
                          ->content(
                            fn() =>
                            Application::whereIn('job_id', $jobIds)->where('status', 'new')->count()
                          ),

                        Placeholder::make('apps_reviewing')
                          ->label('Reviewing')
                          ->content(
                            fn() =>
                            Application::whereIn('job_id', $jobIds)->where('status', 'reviewing')->count()
                          ),

                        Placeholder::make('apps_shortlisted')
                          ->label('Shortlisted')
                          ->content(
                            fn() =>
                            Application::whereIn('job_id', $jobIds)->where('status', 'shortlisted')->count()
                          ),

                        Placeholder::make('apps_interview')
                          ->label('Interview')
                          ->content(
                            fn() =>
                            Application::whereIn('job_id', $jobIds)->where('status', 'interview')->count()
                          ),

                        Placeholder::make('apps_offer')
                          ->label('Offer')
                          ->content(
                            fn() =>
                            Application::whereIn('job_id', $jobIds)->where('status', 'offer')->count()
                          ),

                        Placeholder::make('apps_hired')
                          ->label('Hired')
                          ->content(
                            fn() =>
                            Application::whereIn('job_id', $jobIds)->where('status', 'hired')->count()
                          ),

                        Placeholder::make('apps_rejected')
                          ->label('Rejected')
                          ->content(
                            fn() =>
                            Application::whereIn('job_id', $jobIds)->where('status', 'rejected')->count()
                          ),

                        Placeholder::make('apps_withdraw')
                          ->label('Withdraw')
                          ->content(
                            fn() =>
                            Application::whereIn('job_id', $jobIds)->where('status', 'withdraw')->count()
                          ),
                      ]),
                    ])
                    ->collapsible()
                    ->collapsed(),

                  /*
                  |--------------------------------------------------------------------------
                  | Review Behavior
                  |--------------------------------------------------------------------------
                  */
                  Section::make('Review Behavior')
                    ->schema([
                      Grid::make(3)->schema([

                        Placeholder::make('unread_apps')
                          ->label('Unread Apps')
                          ->content(
                            fn() =>
                            Application::whereIn('job_id', $jobIds)
                              ->where('is_read', 0)
                              ->count()
                          ),

                        Placeholder::make('never_opened')
                          ->label('Never Opened')
                          ->content(
                            fn() =>
                            Application::whereIn('job_id', $jobIds)
                              ->whereNull('read_at')
                              ->count()
                          ),

                        Placeholder::make('oldest_pending')
                          ->label('Oldest Pending')
                          ->content(function () use ($jobIds) {
                            $app = Application::whereIn('job_id', $jobIds)
                              ->whereIn('status', ['new', 'reviewing'])
                              ->oldest()
                              ->first();

                            return $app
                              ? $app->created_at->diffForHumans()
                              : '—';
                          }),
                      ]),
                    ])
                    ->collapsible()
                    ->collapsed(),

                ];
              }
            }
          ),
        EditAction::make(),
        // send verification email acction
        Action::make('sendVerification')
          ->label('Send Verification Email')
          ->icon('heroicon-o-envelope')
          ->color('primary')
          ->requiresConfirmation()
          ->visible(fn($record) => !$record->hasEmailAuthentication())
          ->action(fn($record) => $record->sendEmailVerificationNotification())
          ->successNotificationTitle('Verification email sent'),
      ])
      ->bulkActions([
        BulkActionGroup::make([
          DeleteBulkAction::make(),
          ForceDeleteBulkAction::make(),
          RestoreBulkAction::make(),
          Action::make('sendVerificationEmails')
            ->label('Send Verification Emails')
            ->icon('heroicon-o-envelope')
            ->color('primary')
            ->requiresConfirmation()
            ->modalHeading('Send Verification Emails')
            ->modalDescription('Send verification emails to all selected users who have not verified their email addresses.')
            ->modalSubmitActionLabel('Send Emails')
            ->action(function (Collection $records) {
              $unverifiedUsers = $records->filter(fn($user) => !$user->hasEmailAuthentication());

              if ($unverifiedUsers->isEmpty()) {
                \Filament\Notifications\Notification::make()
                  ->warning()
                  ->title('No unverified users')
                  ->body('All selected users have already verified their email addresses.')
                  ->send();
                return;
              }

              $count = 0;
              foreach ($unverifiedUsers as $user) {
                try {
                  $user->sendEmailVerificationNotification();
                  $count++;
                } catch (\Exception $e) {
                  \Log::error('Failed to send verification email to user: ' . $user->email, [
                    'error' => $e->getMessage()
                  ]);
                }
              }

              \Filament\Notifications\Notification::make()
                ->success()
                ->title('Verification emails sent')
                ->body("Successfully sent {$count} verification email(s).")
                ->send();
            })
            ->deselectRecordsAfterCompletion(),
        ]),
      ]);
  }
}
