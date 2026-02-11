<?php

namespace App\Filament\Resources\Users\Tables;

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
        TextColumn::make('role')
          ->badge()
          ->color(
            fn(string $state): string => match ($state) {
              'company-owner' => 'info',
              'hiring-manager' => 'info',
              'recruiter' => 'gray',
              'job-seeker' => 'warning',
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
        TextColumn::make('deleted_at')
          ->dateTime()
          ->sortable()
          ->toggleable(isToggledHiddenByDefault: true),
      ])
      ->filters([
        SelectFilter::make('role')
          ->options([
            'company-owner' => 'Company Owner',
            'hiring-manager' => 'Hiring Manager',
            'recruiter' => 'Recruiter',
            'job-seeker' => 'Job Seeker',
          ]),
        SelectFilter::make('status')
          ->options([
            'Active' => 'Active',
            'Inactive' => 'Inactive',
          ]),
          
        TrashedFilter::make(),
      ])
      ->actions([
        ViewAction::make()
          ->modalHeading(fn($record) => $record->full_name)
          ->modalWidth('6xl')
          ->visible(fn($record) => $record->role == 'job-seeker')
          ->form([
            Section::make('User Information')
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
                    Placeholder::make('role')
                      ->label('Role')
                      ->content(fn($record) => $record->role),
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
              ->collapsed(),
          ]),
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
