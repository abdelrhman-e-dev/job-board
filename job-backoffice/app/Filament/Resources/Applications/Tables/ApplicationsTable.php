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
use Filament\Infolists\Components\RepeatableEntry;
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
use Illuminate\Support\HtmlString;

class ApplicationsTable
{
  public static function configure(Table $table): Table
  {
    return $table
      ->columns([
        TextColumn::make('jobSeeker.name')
          ->label("Applicant Name")
          // ->searchable()
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
                Section::make('Documents')
                  ->schema([
                    Grid::make(4)
                      ->schema([
                        TextEntry::make('document.file_name')
                          ->label('File Name'),
                        TextEntry::make('document.type')
                          ->label('File Type'),
                        TextEntry::make('document.file_size')
                          ->label('File Size (KB)'),
                        TextEntry::make('document.file_url')
                          ->label('File URL'),
                      ])
                  ])->collapsed(),
                Section::make('Screening Questions')
                  ->schema([
                    TextEntry::make('screening_questions')
                      ->label('')
                      ->columnSpanFull()
                      ->formatStateUsing(function ($state): HtmlString {
                        $questions = is_string($state) ? json_decode($state, true) : $state;

                        if (empty($questions) || !is_array($questions)) {
                          return new HtmlString('<p class="text-sm text-gray-400 italic">No screening questions available.</p>');
                        }

                        $html = '<div style="display:flex;flex-direction:column;gap:12px;">';

                        foreach ($questions as $index => $qa) {
                          $number = $index + 1;
                          $question = e($qa['question'] ?? 'N/A');
                          $answer = e($qa['answer'] ?? 'N/A');

                          $html .= <<<HTML
                            <div style="
                              border: 1px solid rgba(99,102,241,0.25);
                              border-left: 4px solid #6366f1;
                              border-radius: 10px;
                              padding: 14px 18px;
                              background: rgba(99,102,241,0.04);
                            ">
                              <div style="display:flex;align-items:flex-start;gap:10px;margin-bottom:8px;">
                                <span style="
                                  display:inline-flex;align-items:center;justify-content:center;
                                  min-width:24px;height:24px;border-radius:50%;
                                  background:#6366f1;color:#fff;font-size:11px;font-weight:700;
                                  flex-shrink:0;margin-top:1px;
                                ">$number</span>
                                <p style="margin:0;font-size:13.5px;font-weight:600;color:inherit;line-height:1.5;">$question</p>
                              </div>
                              <div style="display:flex;align-items:center;gap:8px;padding-left:34px;">
                                <span style="
                                  font-size:10px;font-weight:700;letter-spacing:.6px;
                                  text-transform:uppercase;color:#6366f1;
                                  background:rgba(99,102,241,0.12);
                                  padding:2px 8px;border-radius:20px;
                                  flex-shrink:0;
                                ">Answer</span>
                                <p style="margin:0;font-size:13px;color:inherit;opacity:.85;">$answer</p>
                              </div>
                            </div>
                          HTML;
                        }

                        $html .= '</div>';

                        return new HtmlString($html);
                      })
                      ->placeholder('No screening questions available')
                      ->html()
                  ])->collapsed(),
                Section::make('Reviews')
                  ->schema([
                    Grid::make(1)
                      ->schema([
                        RepeatableEntry::make('reviews')
                          ->placeholder('No reviews available')
                          ->schema([
                            TextEntry::make('reviewer.name')
                              ->label('Reviewer'),

                            TextEntry::make('reviewer.role.role_name')
                              ->label('Role')
                              ->badge(),

                            TextEntry::make('rating')
                              ->label('Rating')
                              ->suffix(' / 5')
                              ->badge()
                              ->color(fn($state) => match (true) {
                                $state >= 4 => 'success',
                                $state >= 3 => 'warning',
                                default => 'danger',
                              }),

                            TextEntry::make('recommendation')
                              ->label('Recommendation')
                              ->badge()
                              ->color(fn($state) => match ($state) {
                                'accept' => 'success',
                                'reject' => 'danger',
                                default => 'warning',
                              }),

                            TextEntry::make('feedback')
                              ->label('Feedback')
                              ->columnSpanFull(),

                            TextEntry::make('created_at')
                              ->label('Reviewed At')
                              ->dateTime('M d, Y - h:i A')
                              ->icon('heroicon-o-clock'),
                          ])
                          ->columns(2)
                          ->contained(true),
                      ])
                  ])->collapsed(),
                Section::make('Interviews')
                  ->schema([
                    Grid::make(1)
                      ->schema([
                        RepeatableEntry::make('interviews')
                          ->placeholder('No interviews available')
                          ->schema([
                            TextEntry::make('interview_round')
                              ->label('Interview Round'),
                            TextEntry::make('interview_stage')
                              ->badge()
                              ->label('Interview Stage')
                              ->color(fn($state) => match ($state) {
                                'screening' => 'info',
                                'hr' => 'warning',
                                'technical' => 'success',
                                'panel' => 'danger',
                                'final' => 'primary',
                                'offer_discussion' => 'secondary',
                                default => 'gray',
                              }),
                            TextEntry::make('interview_type')
                              ->badge()
                              ->color(fn($state) => match ($state) {
                                'phone' => 'info',
                                'video' => 'warning',
                                'onsite' => 'success',
                                'async_video' => 'danger',
                                'take_home' => 'primary',
                                default => 'gray',
                              })
                              ->label('Interview Type'),
                            TextEntry::make('interviewers.name')
                              ->state(fn($record) => $record->interviewers->name . ' - ' . $record->interviewers->role->role_name)
                              ->label('Interviewer'),
                            TextEntry::make('scheduled_at')
                              ->label('Scheduled At')
                              ->dateTime('M d, Y - h:i A')
                              ->icon('heroicon-o-clock'),
                            TextEntry::make('location')
                              ->visible(fn($record) => $record->interview_type == "onsite")
                              ->label('Location'),
                            TextEntry::make('meeting_link')
                              ->visible(fn($record) => $record->interview_type == "video")
                              ->label('Meeting Link'),
                            TextEntry::make('result')
                              ->badge()
                              ->color(fn($state) => match ($state) {
                                'pending' => 'info',
                                'pass' => 'success',
                                'fail' => 'danger',
                                'no_show' => 'warning',
                                default => 'gray',
                              }),
                            TextEntry::make('score')
                              ->suffix('/ 100')
                              ->label('Score'),
                            TextEntry::make('completed_at')
                              ->label('Completed At')
                              ->dateTime('M d, Y - h:i A')
                              ->icon('heroicon-o-clock'),
                            TextEntry::make('feedback')
                              ->label('Feedback'),
                            TextEntry::make('cancelled_at')
                              ->label('Cancelled At')
                              ->placeholder("Not Cancelled")
                              ->dateTime('M d, Y - h:i A')
                              ->icon('heroicon-o-clock'),
                            TextEntry::make('cancellation_reason')
                              ->label('Cancellation Reason')
                              ->placeholder("Not Cancelled"),

                          ])
                          ->columns(3)
                          ->contained(true),
                      ])
                  ])->collapsed(),
                Section::make('Offers')
                  ->schema([
                    Grid::make(1)
                      ->schema([
                        RepeatableEntry::make('offers')
                          ->placeholder('No offers available')
                          ->schema([
                            TextEntry::make('status')
                              ->badge()
                              ->label('Offer Status')
                              ->color(fn($state) => match ($state) {
                                'draft' => 'info',
                                'sent' => 'warning',
                                'accepted' => 'success',
                                'rejected' => 'danger',
                                'expired' => 'primary',
                                default => 'gray',
                              }),
                            TextEntry::make('offer_type')
                              ->badge()
                              ->label('Offer Type')
                              ->color(fn($state) => match ($state) {
                                'full_time' => 'info',
                                'part_time' => 'warning',
                                'contract' => 'success',
                                'temporary' => 'danger',
                                'internship' => 'primary',
                                default => 'gray',
                              }),
                            TextEntry::make('salary_amount')
                              ->label('Base Salary')
                              ->state(fn($record) => $record->salary . ' ' . $record->currency),
                            TextEntry::make('start_date')
                              ->label('Start Date')
                              ->dateTime('M d, Y - h:i A')
                              ->icon('heroicon-o-clock'),
                            TextEntry::make('end_date')
                              ->label('End Date')
                              ->dateTime('M d, Y - h:i A')
                              ->icon('heroicon-o-clock'),
                            TextEntry::make('notes')
                              ->label('Notes'),
                            TextEntry::make('sent_at')
                              ->label('Sent At')
                              ->visible(fn($record) => $record->status == 'sent')
                              ->dateTime('M d, Y - h:i A')
                              ->icon('heroicon-o-clock'),
                            TextEntry::make('accepted_at')
                              ->label('Accepted At')
                              ->visible(fn($record) => $record->status == 'accepted')
                              ->dateTime('M d, Y - h:i A')
                              ->icon('heroicon-o-clock'),
                            TextEntry::make('rejected_at')
                              ->label('Rejected At')
                              ->visible(fn($record) => $record->status == 'rejected')
                              ->dateTime('M d, Y - h:i A')
                              ->icon('heroicon-o-clock'),
                            TextEntry::make('expires_at')
                              ->label('Expires At')
                              ->visible(fn($record) => $record->status == 'expired')
                              ->dateTime('M d, Y - h:i A')
                              ->icon('heroicon-o-clock'),
                            TextEntry::make('created_at')
                              ->label('Created At')
                              ->dateTime('M d, Y - h:i A')
                              ->icon('heroicon-o-clock'),
                            TextEntry::make('updated_at')
                              ->label('Updated At')
                              ->dateTime('M d, Y - h:i A')
                              ->icon('heroicon-o-clock'),
                            TextEntry::make('deleted_at')
                              ->visible(fn($record) => $record->deleted_at != null)
                              ->label('Deleted At')
                              ->dateTime('M d, Y - h:i A')
                              ->icon('heroicon-o-clock'),
                          ])
                          ->columns(3)
                          ->contained(true),
                      ])
                  ])->collapsed(),
                Section::make('Status History')
                  ->schema([
                    Grid::make(1)
                      ->schema([
                        // [{"status":"new", "changed_at":"2026-01-22 23:10:42", "changed_by":"system"}]
                        RepeatableEntry::make('status_history')
                          ->label('Status History')
                          ->state(fn($record) => $record->status_history ?? [])
                          ->schema([
                            TextEntry::make('status')
                              ->badge()
                              ->color(fn($state) => match ($state) {
                                'new' => 'primary',
                                'reviewing' => 'info',
                                'shortlisted' => 'warning',
                                'interview' => 'warning',
                                'offer' => 'info',
                                'hired' => 'success',
                                'rejected' => 'danger',
                                'withdraw' => 'gray',
                              }),

                            TextEntry::make('changed_at')
                              ->label('Changed At')
                              ->dateTime('M d, Y - h:i A')
                              ->icon('heroicon-o-clock'),

                            TextEntry::make('changed_by')
                              ->state(fn($record) => $record->changed_by ?? "Administrator")
                              ->label('Changed By'),
                          ])
                          ->columns(3)
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
